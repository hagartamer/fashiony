use store2
CREATE TABLE Product (
    Product_ID int NOT NULL,
    Product_name varchar(255) NOT NULL,
    Product_catrgory varchar(255),
    Product_image varchar,
	material varchar(255),
	color varchar(255),
	price varchar(255),
	sale varchar(255),
	arrival_date varchar(255),
    PRIMARY KEY (Product_ID)
);

CREATE TABLE Clint (
    ClintID int NOT NULL PRIMARY KEY,
    ClintName varchar(255) NOT NULL,
	ClintPhone varchar(255),
	e_mail varchar(255),
    website_password varchar(255),
);


CREATE TABLE Orders (
    OrderID int NOT NULL PRIMARY KEY,
    OrderNumber int ,
    ClintID int FOREIGN KEY REFERENCES Clint(ClintID),
	Product_ID int FOREIGN KEY REFERENCES Product(Product_ID)


);
CREATE TABLE Delivery (OrderID int foreign key REFERENCES Orders
(OrderID),
delivary_date date ,
shiping_company varchar,
shipping_operator varchar,
review varchar
constraint Delivery_PK primary key(OrderID)
)