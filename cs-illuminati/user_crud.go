package main

func (u *User) Create() error {
	db := GetDB()
	if result := db.Create(u); result.Error != nil {
		return result.Error
	}
	return nil
}

func ReadUser(userID uint) (*User, error) {
	db := GetDB()
	user := &User{}
	if result := db.Where("UserID = ?", userID).First(&user); result.Error != nil {
		return nil, result.Error
	}
	return user, nil
}

func ReadUserByEmail(email string) (*User, error) {
	db := GetDB()
	user := &User{}
	if result := db.Where("Email = ?", email).First(&user); result.Error != nil {
		return nil, result.Error
	}
	return user, nil
}

func UpdateUser() {

}

func DeleteUser() {

}
