package main

import (
	"fmt"
	"html/template"
	"log"
	"net/http"
	"strconv"

	"github.com/gin-contrib/sessions"
	"github.com/gin-contrib/sessions/cookie"
	"github.com/gin-gonic/gin"
)

var register = template.Must(template.ParseFiles("./static/register.html"))
var admin = template.Must(template.ParseFiles("./static/admin.html"))
var login = template.Must(template.ParseFiles("./static/login.html"))
var home = template.Must(template.ParseFiles("./static/home.html"))
var single_post = template.Must(template.ParseFiles("./static/single_post.html"))

func Router(r *gin.Engine) {
	//home handler
	r.GET("/", AuthMiddleWare, func(ctx *gin.Context) {
		posts, err := ListPost()
		if err != nil {
			fmt.Printf("err.Error(): %v\n", err.Error())
			home.Execute(ctx.Writer, map[string]interface{}{
				"Error": "unknown error occured",
				"Posts": nil,
			})
			return
		}

		home.Execute(ctx.Writer, map[string]interface{}{
			"Error": "",
			"Posts": posts,
		})

	})
	r.POST("/api/login", func(ctx *gin.Context) {
		session := sessions.Default(ctx)

		password := ctx.Request.FormValue("password")
		email := ctx.Request.FormValue("email")
		if password == "" || email == "" {
			login.Execute(ctx.Writer, map[string]interface{}{
				"Error": "Some fields are empty",
			})
			return
		}
		if !IsvalidEmail(email) {
			login.Execute(ctx.Writer, map[string]interface{}{
				"Error": "email is badly formatted",
			})
			return
		}
		user, err := ReadUserByEmail(email)
		if err != nil {
			login.Execute(ctx.Writer, map[string]interface{}{
				"Error": "Incorrect email and password",
			})
			return
		}

		isPasswordCorrect := CompairHashAndPassword(user.Password, password)
		if isPasswordCorrect {
			session.Set("useremail", user.Email)
			session.Set("role", user.Role)
			if err := session.Save(); err != nil {
				fmt.Printf("err.Error(): %v\n", err.Error())
			}
			http.Redirect(ctx.Writer, ctx.Request, "/", http.StatusSeeOther)
			return
		} else {
			login.Execute(ctx.Writer, map[string]interface{}{
				"Error": "Incorrect email and password",
			})
			return
		}
	})

	r.GET("/login", func(ctx *gin.Context) {
		login.Execute(ctx.Writer, map[string]interface{}{
			"Error": "",
		})
	})
	r.GET("/register", func(ctx *gin.Context) {
		register.Execute(ctx.Writer, map[string]interface{}{
			"Error": "Incorrect email and password",
		})
	})

	r.POST("/api/register", func(ctx *gin.Context) {
		session := sessions.Default(ctx)
		username := ctx.Request.FormValue("username")
		password := ctx.Request.FormValue("password")
		retype_password := ctx.Request.FormValue("retype_password")
		email := ctx.Request.FormValue("email")
		if username == "" || password == "" || email == "" {
			register.Execute(ctx.Writer, map[string]interface{}{
				"Error": "some fields are empty",
			})
			return
		}

		if password != retype_password {
			register.Execute(ctx.Writer, map[string]interface{}{
				"Error": "Passwords do not match",
			})
			return
		}

		if !IsvalidEmail(email) {
			register.Execute(ctx.Writer, map[string]interface{}{
				"Error": "email badly formatted",
			})
			return
		}

		u := &User{
			Email:    email,
			Role:     "admin",
			Username: username,
		}
		u.Password = CreatePasswordFromString(password)
		if err := u.Create(); err != nil {
			register.Execute(ctx.Writer, map[string]interface{}{
				"Error": "unknown error occured please try again",
			})
			return
		}
		session.Set("useremail", u.Email)
		session.Set("role", u.Role)
		if err = session.Save(); err != nil {
			register.Execute(ctx.Writer, map[string]interface{}{
				"Error": "unknown error occured please try again",
			})
			return
		}
		ctx.Redirect(http.StatusSeeOther, "/")
	})

	r.GET("/admin", AuthMiddleWare, AdminMiddleWare, func(ctx *gin.Context) {
		admin.Execute(ctx.Writer, map[string]interface{}{
			"Error": "",
		})
	})

	r.POST("/api/admin/createpost", AuthMiddleWare, AdminMiddleWare, func(ctx *gin.Context) {
		session := sessions.Default(ctx)
		postname := ctx.Request.FormValue("postname")
		price := ctx.Request.FormValue("price")
		catagory := ctx.Request.FormValue("catagory")
		if postname == "" || price == "" || catagory == "" {
			admin.Execute(ctx.Writer, map[string]interface{}{
				"Error": "some fields are empty",
			})
			return
		}
		email := session.Get("useremail").(string)
		user, err := ReadUserByEmail(email)
		if err != nil {
			admin.Execute(ctx.Writer, map[string]interface{}{
				"Error": "uknown error occurred",
			})
			return
		}
		post := &Post{
			PostName: postname,
			Price:    price,
			UserID:   user.UserID,
		}
		if err := post.Create(); err != nil {
			admin.Execute(ctx.Writer, map[string]interface{}{
				"Error": "uknown error occurred",
			})
			return
		}
		admin.Execute(ctx.Writer, map[string]interface{}{
			"Error": "Post created !",
		})
	})

	r.GET("/api/post/:id", func(ctx *gin.Context) {
		post := &Post{}
		postId := ctx.Param("id")
		postIDInt, err := strconv.ParseUint(postId, 10, 64)
		if err != nil {
			panic(err)
		}
		err = post.Read(postIDInt)
		if err != nil {
			single_post.Execute(ctx.Writer, map[string]interface{}{
				"Error": "uknown error occurred",
			})
			return
		}

		single_post.Execute(ctx.Writer, map[string]interface{}{
			"Error": "",
			"Post":  post,
		})
	})

	r.POST("/api/placeorder", AuthMiddleWare, func(ctx *gin.Context) {
		// salaryNeeded := 1000000

	})
}

func createAdminUser() {
	user := &User{
		Email:    "me@shaneumayanga.com",
		Role:     "admin",
		Username: "shane",
		Password: "password",
	}
	user.Create()
}

func main() {
	Migrate()
	r := gin.Default()
	store := cookie.NewStore([]byte("secret"))
	r.Use(sessions.Sessions("session", store))
	Router(r)
	// createAdminUser()
	svc := &http.Server{
		Addr:    ":8080",
		Handler: r,
	}
	fmt.Println("Server starting on port :8080")
	log.Fatal(svc.ListenAndServe())

}
