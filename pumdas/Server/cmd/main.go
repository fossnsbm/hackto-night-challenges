// Package List
//
// go get github.com/gorilla/handlers &&
// go get github.com/gorilla/mux &&
// go get github.com/gorilla/handlers &&
// go get github.com/lib/pq &&
// go get github.com/gorilla/schema &&
// go get github.com/gorilla/sessions &&
// go get github.com/gorilla/securecookie &&
// go get github.com/antonlindstrom/pgstore

package main

import (
	"fmt"
	"net/http"

	"github.com/gorilla/mux"
)

const (
	CONN_HOST = "127.0.0.1"
	CONN_PORT = "8080"

	DB_HOST   = "127.0.0.1"
	DB_PORT   = "5432"
	DB_USER   = "admin"
	DB_PASS   = "1234"
)

func main() {
	router := mux.NewRouter()
	router.PathPrefix("/resources/").Handler(http.StripPrefix("/resources/", http.FileServer(http.Dir("thm/"))))

	router.HandleFunc("/", Route_404).Methods("GET")
	router.HandleFunc("/home", Route_Home).Methods("GET")
	router.HandleFunc("/sell", Route_Sell).Methods("GET")
	router.HandleFunc("/cart", Route_Cart).Methods("GET")
	router.HandleFunc("/profile", Route_Profile).Methods("GET")

	fmt.Println("> To open web Server, URL is http://" + CONN_HOST + ":" + CONN_PORT)
	router_error := http.ListenAndServe(CONN_HOST + ":" + CONN_PORT, router)

	if router_error != nil {
		fmt.Println("> Unable to start web server : ", router_error)
		return
	}
}
