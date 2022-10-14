package main

func Migrate() {
	db := GetDB()
	err := db.AutoMigrate(&User{}, &Feedback{})
	if err != nil {
		panic(err)
	}
}
