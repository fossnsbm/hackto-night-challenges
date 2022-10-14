package main

import "net/mail"

func IsvalidEmail(email string) bool {
	_, err := mail.ParseAddress(email)
	return err == nil
}
