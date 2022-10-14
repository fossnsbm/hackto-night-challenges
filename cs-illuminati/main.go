package main

import (
	"fmt"
	"log"
	"net/http"

	"github.com/gin-gonic/gin"
)

func Router(r *gin.Engine) {
	//home handler
	r.GET("/", AuthMiddleWare, func(ctx *gin.Context) {

	})

	r.POST("/api/login", AuthMiddleWare, func(ctx *gin.Context) {

	})

	r.POST("/api/register", AuthMiddleWare, func(ctx *gin.Context) {

	})

	r.GET("/api/admin", AdminMiddleWare, AdminMiddleWare, func(ctx *gin.Context) {

	})

}

func main() {
	r := gin.Default()

	r.Use(gin.Recovery())

	Router(r)

	svc := &http.Server{
		Addr:    ":8080",
		Handler: r,
	}
	fmt.Println("Server starting on port :8080")
	log.Fatal(svc.ListenAndServe())

}
