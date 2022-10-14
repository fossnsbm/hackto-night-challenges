package main

import "github.com/gin-gonic/gin"

func SaveSession(ctx *gin.Context, user *User) {

}

//returns a user and a bool, true if is admin
func GetUserFromSession() (*User, bool) {

	user := User{}

	return &user, true
}
