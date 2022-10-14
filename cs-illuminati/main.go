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

func Router(r *gin.Engine) {
	//home handler
	r.GET("/", AuthMiddleWare, func(ctx *gin.Context) {

	})
	r.POST("/api/login", AuthMiddleWare, func(ctx *gin.Context) {

	})
	r.GET("/login", func(ctx *gin.Context) {

	})
	r.GET("/register", func(ctx *gin.Context) {
		register.Execute(ctx.Writer, nil)
	})

	r.POST("/api/register", AuthMiddleWare, func(ctx *gin.Context) {
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
		register.Execute(ctx.Writer, nil)
	})

	r.GET("/api/admin", AdminMiddleWare, AdminMiddleWare, func(ctx *gin.Context) {

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
