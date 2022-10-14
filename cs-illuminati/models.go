package main

type User struct {
	Email     string
	Role      string
	UserID    uint `gorm:"primaryKey"`
	Username  string
	Password  string
	Feedbacks []Feedback `gorm:"foreignKey:UserID"`
	Posts     []Post     `gorm:"foreignKey:UserID"`
	Cart      []Cart     `gorn:"foreignKey:UserID"`
}

type Cart struct {
	PostName string
	UserID   uint
}
type Feedback struct {
	FeedbackID   uint `gorm:"primaryKey"`
	UserID       uint
	FeedbackText string
}

type Post struct {
	PostID   uint `gorm:"primaryKey"`
	PostName string
	Price    string
	UserID   uint
	Catagory string
}
