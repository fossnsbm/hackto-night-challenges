package main

import "golang.org/x/crypto/bcrypt"

func CreatePasswordFromString(password string) string {
	hashedPassword, err := bcrypt.GenerateFromPassword([]byte(password), 10)
	if err != nil {
		panic(err)
	}
	return string(hashedPassword)
}

//true if it is a match
func CompairHashAndPassword(hashedPassword string, password string) bool {
	err := bcrypt.CompareHashAndPassword([]byte(hashedPassword), []byte(password))
	return err == nil
}
