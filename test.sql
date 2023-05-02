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
