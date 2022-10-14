package main

func (p *Post) Create() error {
	db := GetDB()
	if result := db.Create(p); result.Error != nil {
		return result.Error
	}
	return nil
}

func (p *Post) Read(postID uint64) error {
	db := GetDB()
	if result := db.Where("PostID = ?", postID).First(p); result.Error != nil {
		return result.Error
	}
	return nil
}

func ListPost() ([]Post, error) {
	posts := []Post{}
	db := GetDB()
	if result := db.Find(&posts); result.Error != nil {
		return []Post{}, result.Error
	}
	return posts, nil
}

func (p *Post) Delete() {

}
