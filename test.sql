CREATE TABLE `pre_order` ( 
  `Auto_number` int(11) NOT NULL, 
  `Pre_Order_id` varchar(4) NOT NULL, 
  `PreOrder_day` date NOT NULL, 
  `PreOrder_detail` varchar(4) NULL, 
  `PreOrder_quantity` varchar(300) NOT NULL, 
  `Unit_id`varchar(100) NOT NULL,
  `Customer_id`varchar(100) NOT NULL,
  `Employee_id`varchar(100) NOT NULL 
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE `Deliver` 
ADD PRIMARY KEY (`Pre_Order_id`);

INSERT INTO `Deliver` (`Auto_number`, `Pre_Order_id`, `PreOrder_day`, `PreOrder_detail`, `PreOrder_quantity`, `Unit_id`, `Customer_id`, `Employee_id`) 
VALUES (1, 'DV01', '30/11/2564', 'PO01', '699 หมู่2 ถ.สุขมุ วิท ต.ทา้ยบา้น อ.เมืองจ.สมทุ รปราการ 10280', 'EM01'), 
(2, 'DV02', '30/11/2564', 'PO02', '87 ถ.สุขมุ วิท ต.ปากน้า อ.เมืองจ.สมทุ รปราการ 10270', 'EM02');

CREATE TABLE `deliver` ( 
  `Auto_number` int(11) NOT NULL, 
  `Deliver_id` varchar(4) NOT NULL, 
  `Deliver_day` date NOT NULL, 
  `Pre_Order_id` varchar(4) NOT NULL, 
  `PreOrder_day` date NOT NULL, 
  `PreOrder_detail` varchar(100) NULL, 
  `PreOrder_quantity` varchar(300) NOT NULL, 
  `Unit_id`varchar(100) NOT NULL,
  `Customer_id`varchar(100) NOT NULL,
  `Deliver_address` varchar(100) NOT NULL,
  `Employee_id`varchar(100) NOT NULL 
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE `Deliver` 
ADD PRIMARY KEY (`Deliver_id`);

INSERT INTO `Deliver` (`Auto_number`, `Pre_Order_id`, `PreOrder_day`, `PreOrder_detail`, `PreOrder_quantity`, `Unit_id`, `Customer_id`, `Employee_id`) 
VALUES (1, 'DV01', '30/11/2564', 'PO01', '699 หมู่2 ถ.สุขมุ วิท ต.ทา้ยบา้น อ.เมืองจ.สมทุ รปราการ 10280', 'EM01'), 
(2, 'DV02', '30/11/2564', 'PO02', '87 ถ.สุขมุ วิท ต.ปากน้า อ.เมืองจ.สมทุ รปราการ 10270', 'EM02');

CREATE TABLE `Buy_Material` ( 
  `Auto_number` int(11) NOT NULL, 
  `BuyMaterial_id` varchar(4) NOT NULL, 
  `BuyMaterial_day` date NOT NULL, 
  `BuyMaterial_detail` varchar(200) NOT NULL, 
  `Material_id` varchar(4) NOT NULL, 
  `BuyMaterial_quantity` varchar(5) NULL, 
  `Unit_id` varchar(4) NOT NULL, 
  `MaterialType_id`varchar(4) NOT NULL,
  `Employee_id`varchar(100) NOT NULL,
  `Partner_id` varchar(4) NOT NULL,
  `BuyMaterial_status`varchar(20) NOT NULL 
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

  
ALTER TABLE `Buy_Material` 
ADD PRIMARY KEY (`BuyMaterial_id`);

CREATE TABLE `Accept_Material` ( 
  `Auto_number` int(11) NOT NULL, 
  `AcceptMaterial_id` varchar(4) NOT NULL, 
  `AcceptMaterial_day` date NOT NULL, 
  `BuyMaterial_id` varchar(200) NOT NULL, 
  `Material_id` varchar(4) NOT NULL, 
  `BuyMaterial_day`date NOT NULL,  
  `BuyMaterial_detail` varchar(200) NOT NULL, 
  `BuyMaterial_quantity` varchar(5) NULL, 
  `Unit_id` varchar(4) NOT NULL, 
  `MaterialType_id`varchar(4) NOT NULL,
  `Partner_id`varchar(4) NOT NULL,
  `Employee_id`varchar(100) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

  
ALTER TABLE `Accept_Material` 
ADD PRIMARY KEY (`AcceptMaterial_id`);

CREATE TABLE `pickup_material` ( 
  `Auto_number` int(11) NOT NULL, 
  `PickupMaterial_id` varchar(4) NOT NULL, 
  `PickupMaterial_day` date NOT NULL, 
  `Material_id` varchar(4) NOT NULL, 
  `Material_name` varchar(100) NOT NULL, 
  `PickupMaterial_quantity` varchar(10) NOT NULL, 
  `Unit_id` varchar(100) NULL, 
  `MaterialType_id` varchar(100) NOT NULL, 
  `Employee_id` varchar(100) NOT NULL,
  `PickupMaterial_status` varchar(20) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

  
ALTER TABLE `Pickup_Material` 
ADD PRIMARY KEY (`PickupMaterial_id`);

CREATE TABLE `material` ( 
  `Auto_number` int(11) NOT NULL, 
  `Material_id` varchar(4) NOT NULL, 
  `Material_name` varchar(10) NOT NULL, 
  `Material_quantity` varchar(10) NOT NULL, 
  `Unit_id` varchar(4) NOT NULL, 
  `MaterialType_id` varchar(4) NULL, 
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

  
ALTER TABLE `Pickup_Material` 
ADD PRIMARY KEY (`PickupMaterial_id`);

CREATE TABLE `Takeback` ( 
  `Auto_number` int(11) NOT NULL, 
  `Takeback_id` varchar(4) NOT NULL, 
  `Takeback _day` date NOT NULL, 
  `PickupMaterial_id` varchar(200) NOT NULL
  `PickupMaterial_day` date NULL, 
  `PickupMaterial_quantity` varchar(200) NULL, 
  `Material_id` varchar(200) NULL, 
  `Material_name` varchar(200) NULL, 
  `Takeback_quantity` varchar(200) NULL, 
  `Unit_id` varchar(200) NULL, 
  `MaterialType_id` varchar(200) NULL, 
  `Employee_id` varchar(200) NULL, 
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

  
ALTER TABLE `Takeback` 
ADD PRIMARY KEY (`Takeback_id`);


CREATE TABLE `License` ( 
  `Auto_number` int(11) NOT NULL, 
  `License_id` varchar(4) NOT NULL, 
  `License_name` varchar(10) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE `License` 
ADD PRIMARY KEY (`License_id`);


CREATE TABLE `partner` ( 
  `Auto_number` int(11) NOT NULL, 
  `Partner_id` varchar(4) NOT NULL, 
  `Prefix_id` varchar(10) NOT NULL, 
  `Partner_name` varchar(10) NOT NULL, 
  `Partner_surname` varchar(10) NOT NULL, 
  `Partner_number` int(10) NULL, 
  `Partner_email` varchar(20) NULL, 
  `Partner_company` varchar(4) NULL, 
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

  
ALTER TABLE `partner` 
ADD PRIMARY KEY (`Partner_id`);

CREATE TABLE `user` ( 
  `ID` int(11) NOT NULL, 
  `Username` varchar(10) NOT NULL, 
  `Password` varchar(10) NOT NULL, 
  `Employee_id` varchar(50) NOT NULL, 
  `License_id` int(10) NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

  
ALTER TABLE `user` 
ADD PRIMARY KEY (`ID`);

CREATE TABLE `employee` ( 
  `Auto_number` int(11) NOT NULL, 
  `Employee_id` varchar(4) NOT NULL, 
  `Prefix_id` varchar(4) NOT NULL, 
  `Employee_name` varchar(50) NOT NULL, 
  `Employee_surname` varchar(50) NULL,
  `Employee_name` varchar(10) NOT NULL, 
  `Employee_address` varchar(100) NULL,
  `EmployeeType_id` varchar(100) NOT NULL, 
  `Employee_license` varchar(100) NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE PreOrder_detail (
    preorder_detail_id varchar(4) NOT NULL,
    preorder_id varchar(4) NOT NULL,
    product_id varchar(4) NOT NULL,
    quantity varchar(4) NOT NULL,
    price DECIMAL(10,2) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE `PreOrder_detail` 
ADD PRIMARY KEY (`preorder_detail_id`);

ALTER TABLE `PreOrder_detail` 
FOREIGN KEY (preorder_id) REFERENCES PreOrder(preorder_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)


    CREATE TABLE `material` ( 
  `Auto_number` int(11) NOT NULL, 
  `Material_id` varchar(4) NOT NULL, 
  `Material_name` varchar(10) NOT NULL, 
  `Material_quantity` int(100) NULL,
  `Unit_id` varchar(10) NOT NULL, 
  `MaterialType_id` varchar(100) NULL,
  `price_per_piece` int(100) NOT NULL, 
  `total_price` int(100) NOT NULL, 
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

  ALTER TABLE `material` 
ADD PRIMARY KEY (`Material_id`);

    CREATE TABLE `pre_order` ( 
  `Auto_number` int(11) NOT NULL, 
  `PreOrder_id` varchar(4) NOT NULL, 
  `PreOrder_detail_id` varchar(4) NOT NULL, 
  `PreOrder_day` varchar(10) NOT NULL, 
  `Customer_id` varchar(4) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

  ALTER TABLE `pre_order` 
ADD PRIMARY KEY (`PreOrder_id`);

    CREATE TABLE `material` ( 
  `Auto_number` int(11) NOT NULL, 
  `Material_id` varchar(4) NOT NULL, 
  `Material_name` varchar(50) NULL,
  `Material_quantity` int NULL,
  `counting_id` varchar(4) NOT NULL, 
  `MaterialType_id` varchar(4) NOT NULL, 
  `Material_price` int NOT NULL,
  `Price_unit` varchar(4) NOT NULL, 
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

  ALTER TABLE `material` 
ADD PRIMARY KEY (`Material_id`);

-- Create the tb_po table
CREATE TABLE tb_po (
  code VARCHAR(10) PRIMARY KEY,
  order_date DATE NOT NULL,
  customer_name VARCHAR(50) NOT NULL,
  employee_name VARCHAR(50) NOT NULL
);

-- Create the tb_pod table
CREATE TABLE tb_pod (
  id INT PRIMARY KEY AUTO_INCREMENT,
  code VARCHAR(10) NOT NULL,
  name VARCHAR(50) NOT NULL,
  quantity INT NOT NULL,
  counting_unit VARCHAR(20) NOT NULL,
  price FLOAT NOT NULL,
  price_unit VARCHAR(10) NOT NULL,
  po_code VARCHAR(10) NOT NULL,
  FOREIGN KEY (po_code) REFERENCES tb_po(code)
);

    CREATE TABLE `pre_order` ( 
  PreOrder_id varchar(4) PRIMARY KEY, 
  PreOrder_day varchar(10) NOT NULL, 
  Customer_id varchar(4) NOT NULL,
  Employee_id varchar(4) NOT NULL
  );

 CREATE TABLE `pre_order_detail` ( 
  PreOrder_detail_id varchar(5) PRIMARY KEY, 
  PreOrder_detail varchar(100) NULL,
  PreOrder_quantity int NOT NULL, 
  Counting_unit varchar(10) NOT NULL, 
  PreOrder_price int NOT NULL, 
  Price_unit varchar(4) NOT NULL,
  PreOrder_id  varchar(4) NOT NULL,
  FOREIGN KEY (PreOrder_id ) REFERENCES pre_order(PreOrder_id)
);


  ALTER TABLE `pre_order_detail` 
ADD PRIMARY KEY (`PreOrder_detail_id`);

  CREATE TABLE `deliver` ( 
  Deliver_id varchar(4) PRIMARY KEY, 
  Deliver_day date NOT NULL, 
  Deliver_address varchar(50) NOT NULL,
  Employee_id varchar(4) NOT NULL
  );

 CREATE TABLE `deliver_detail` ( 
  Deliver_detail_id varchar(5) PRIMARY KEY, 
  Deliver_detail varchar(100) NULL,
  Deliver_quantity int NOT NULL, 
  Counting_unit varchar(10) NOT NULL, 
  Deliver_price int NOT NULL, 
  Price_unit varchar(4) NOT NULL,
  Customer_id varchar(4) NOT NULL,
  Deliver_id varchar(4) NOT NULL,
  FOREIGN KEY (Deliver_id) REFERENCES deliver(Deliver_id)
);

   CREATE TABLE `buy_material` ( 
  BuyMaterial_id varchar(4) PRIMARY KEY, 
  BuyMaterial_day varchar(10) NOT NULL, 
  Partner_id varchar(4) NOT NULL,
  Employee_id varchar(4) NOT NULL,
  BuyMaterial_status varchar(4) NOT NULL
  );

 CREATE TABLE `buy_material_detail` ( 
  BuyMaterial_detail_id varchar(5) PRIMARY KEY, 
  BuyMaterial_detail varchar(100) NULL,
  BuyMaterial_quantity int NOT NULL, 
  Counting_unit varchar(10) NOT NULL, 
  PreOrder_price int NOT NULL, 
  Price_unit varchar(4) NOT NULL,
  MaterialType_id varchar(4) NOT NULL,
  BuyMaterial_id varchar(4) NOT NULL,
  FOREIGN KEY (BuyMaterial_id) REFERENCES buy_material(BuyMaterial_id)
);
  
CREATE TABLE `accept_material` ( 
  AcceptMaterial_id varchar(4) PRIMARY KEY, 
  AcceptMaterial_day varchar(10) NOT NULL, 
  Partner_id varchar(4) NOT NULL,
  Employee_id varchar(4) NOT NULL
);

CREATE TABLE `accept_material_detail` ( 
  AcceptMaterial_detail_id varchar(5) PRIMARY KEY, 
  AcceptMaterial_detail varchar(100) NULL,
  AcceptMaterial_quantity int NOT NULL, 
  Counting_unit varchar(10) NOT NULL, 
  AcceptMaterial_price int NOT NULL, 
  Price_unit varchar(4) NOT NULL,
  MaterialType_id varchar(4) NOT NULL,
  AcceptMaterial_id varchar(4) NOT NULL,
  FOREIGN KEY (AcceptMaterial_id) REFERENCES accept_material(AcceptMaterial_id)
);

CREATE TABLE `pickup_material` ( 
  PickupMaterial_id varchar(4) PRIMARY KEY, 
  PickupMaterial_day varchar(10) NOT NULL, 
  Employee_id varchar(4) NOT NULL,
  PickupMaterial_status varchar(4) NOT NULL
);

CREATE TABLE `pickup_material_detail` ( 
  PickupMaterial_detail_id varchar(5) PRIMARY KEY, 
  AcceptMaterial_detail varchar(100) NULL,
  PickupMaterial_quantity int NOT NULL, 
  Counting_unit varchar(10) NOT NULL, 
  AcceptMaterial_price int NOT NULL, 
  Price_unit varchar(4) NOT NULL,
  MaterialType_id varchar(4) NOT NULL,
  AcceptMaterial_id varchar(4) NOT NULL,
  FOREIGN KEY (AcceptMaterial_id) REFERENCES accept_material(AcceptMaterial_id)
);