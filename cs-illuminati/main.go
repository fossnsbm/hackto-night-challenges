package main

import (
	"fmt"
	"html/template"
	"log"
	"net/http"

	"github.com/gin-contrib/sessions"
	"github.com/gin-contrib/sessions/cookie"
	"github.com/gin-gonic/gin"
)

var register = template.Must(template.ParseFiles("./static/register.html"))
var admin = template.Must(template.ParseFiles("./static/admin.html"))
var login = template.Must(template.ParseFiles("./static/login.html"))

func Router(r *gin.Engine) {
	//home handler
	r.GET("/", AuthMiddleWare, func(ctx *gin.Context) {

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
			panic(err)
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
		register.Execute(ctx.Writer, nil)
	})

	r.POST("/api/register", func(ctx *gin.Context) {
		session := sessions.Default(ctx)
		username := ctx.Request.FormValue("username")
		password := ctx.Request.FormValue("password")
		email := ctx.Request.FormValue("email")

		if !IsvalidEmail(email) {
			panic("email is not valid!!!!")
		}

		u := &User{
			Email:    email,
			Role:     "customer",
			Username: username,
		}
		u.Password = CreatePasswordFromString(password)
		if err := u.Create(); err != nil {
			panic(err)
		}
		session.Set("useremail", u.Email)
		session.Set("role", u.Role)
		if err = session.Save(); err != nil {
			panic(err)
		}
		ctx.Redirect(http.StatusSeeOther, "/")
	})

	r.GET("/admin", AuthMiddleWare, AdminMiddleWare, func(ctx *gin.Context) {
		admin.Execute(ctx.Writer, nil)
	})

	r.POST("/api/admin/createpost", AuthMiddleWare, AdminMiddleWare, func(ctx *gin.Context) {
		session := sessions.Default(ctx)
		postname := ctx.Request.FormValue("postname")
		price := ctx.Request.FormValue("price")
		email := session.Get("email").(string)
		user, err := ReadUserByEmail(email)
		if err != nil {
			panic(err)
		}
		post := &Post{
			PostName: postname,
			Price:    price,
			UserID:   user.UserID,
		}
		if err := post.Create(); err != nil {
			panic(err)
		}
		admin.Execute(ctx.Writer, nil)
	})
}

func main() {
	Migrate()
	r := gin.Default()
	store := cookie.NewStore([]byte("secret"))
	r.Use(sessions.Sessions("session", store))
	Router(r)
	svc := &http.Server{
		Addr:    ":8080",
		Handler: r,
	}
	fmt.Println("Server starting on port :8080")
	log.Fatal(svc.ListenAndServe())

}
