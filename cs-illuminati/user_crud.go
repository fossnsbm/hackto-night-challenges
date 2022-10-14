package main

func (u *User) Create() error {
	db := GetDB()
	if result := db.Create(u); result.Error != nil {
		return result.Error
	}
	return nil
}

func ReadUser() {

}

func UpdateUser() {

}

func DeleteUser() {

}
