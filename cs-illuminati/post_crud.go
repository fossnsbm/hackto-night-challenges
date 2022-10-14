package main

func (p *Post) Create() error {
    db := GetDB()
    if result := db.Create(p); result.Error != nil {
        return result.Error
    }
    return nil
}

func (p *Post) Read(postID uint) (*Post, error) {
    db := GetDB()

    if result := db.Where("PostID = ?", postID).First(p); result.Error != nil {
        return nil, result.Error
    }
    return post, nil
}

func (p *Post) Update() {

}

func (p *Post) Delete() {

}