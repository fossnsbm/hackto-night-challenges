package main

import (
	"fmt"
	"net/http"
	"text/template"
)

func Check_Error(err error) {
	if err != nil {
			fmt.Println("> Error Found ")
			panic(err)
	}
}

func Route_404(w http.ResponseWriter, r *http.Request) {
	parsedTemplate, err := template.ParseFiles("thm/")

	if err != nil {
		fmt.Println("> Unable to parse html file : ", err)
		return
	}

	parsedTemplate.Execute(w, nil)
}

func Route_Home(w http.ResponseWriter, r *http.Request) {
	parsedTemplate, err := template.ParseFiles("thm/")

	if err != nil {
		fmt.Println("> Unable to parse html file : ", err)
		return
	}

	parsedTemplate.Execute(w, nil)
}

func Route_Sell(w http.ResponseWriter, r *http.Request) {
	parsedTemplate, err := template.ParseFiles("thm/")

	if err != nil {
		fmt.Println("> Unable to parse html file : ", err)
		return
	}

	parsedTemplate.Execute(w, nil)
}

func Route_Cart(w http.ResponseWriter, r *http.Request) {
	parsedTemplate, err := template.ParseFiles("thm/")

	if err != nil {
		fmt.Println("> Unable to parse html file : ", err)
		return
	}

	parsedTemplate.Execute(w, nil)
}

func Route_Profile(w http.ResponseWriter, r *http.Request) {
	parsedTemplate, err := template.ParseFiles("thm/")

	if err != nil {
		fmt.Println("> Unable to parse html file : ", err)
		return
	}

	parsedTemplate.Execute(w, nil)
}
