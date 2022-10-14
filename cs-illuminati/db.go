package main

import (
	"fmt"

	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

var db *gorm.DB
var err error

func GetDB() *gorm.DB {
	dsn := "root:#&9ydSfr_r8H@tcp(127.0.0.1:3306)/bbh?charset=utf8mb4&parseTime=True&loc=Local"
	if db == nil {
		db, err = gorm.Open(mysql.Open(dsn), &gorm.Config{})
		if err != nil {
			panic(err)
		}
		fmt.Println("Data connection initialized")
	}
	return db
}
