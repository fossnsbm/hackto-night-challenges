/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package additem;

import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author avish
 */
class additem {
    Statement st;
    void listItem(String item_name, String item_category, String item_price) {
        String url = "jdbc:mysql://localhost:3306/flight_management_system";
        String sql = "INSERT INTO taransport(country_from, country_to, depart_date, return_date, flight_class, price) VALUES('"+item_name+"', '"+item_category+"', '"+item_price+"')";       
        try {
            Class.forName("com.mysql.jdbc.Driver");
            Connection con = DriverManager.getConnection(url,"root","");
            st = con.createStatement();
            st.executeUpdate(sql);
        } catch (ClassNotFoundException | SQLException ex) {
            Logger.getLogger(additem.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
}
