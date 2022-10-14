package main

import (
	"net/http"

	"github.com/gin-contrib/sessions"
	"github.com/gin-gonic/gin"
)

func AuthMiddleWare(ctx *gin.Context) {
	session := sessions.Default(ctx)
	email := session.Get("useremail")
	role := session.Get("role")
	if email == nil || role == nil {
		ctx.Redirect(http.StatusSeeOther, "/login")
		ctx.Abort()
	}

}

func AdminMiddleWare(ctx *gin.Context) {
	session := sessions.Default(ctx)
	role := session.Get("role")
	roleStr := role.(string)
	if roleStr != "admin" {
		ctx.Redirect(http.StatusSeeOther, "/")
		ctx.Abort()
	}
}
