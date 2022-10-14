package main

func Migrate() {
	db := GetDB()
	err := db.AutoMigrate(&User{}, &Feedback{}, &Post{})
	if err != nil {
		panic(err)
	}
}
