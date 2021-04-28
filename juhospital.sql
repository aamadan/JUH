-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 03:18 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juhospital`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `prescription_sales_info` (IN `p_id` INT)  NO SQL
SELECT p.id, p.brand_name,d.name "category_name",p.category,c.name "country",p.sell_price,pr.quantity "prescription_qty",p.num_strp_per_pack,p.num_pills_per_pack,p.num_inj_per_pack
FROM product_info p 
INNER JOIN prescription pr ON pr.drug_id=p.id 
INNER JOIN country c ON c.id=p.country 
INNER JOIN drug_category d ON d.id=p.category 
WHERE pr.prescription_serial=p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rpt_marketer` ()  NO SQL
BEGIN
SELECT m.id "Marketer ID",m.name"Marketer Name",m.tel"Marketer Tell",m.email "Marketer email",m.address "Marketer Address",m.date,CONCAT('<a href="actions/edit.php?table=marketer&form=sys_forms/frm_addMarketer.php&sp=sp_marketer&id=',m.id,'" data-form-label="Edit Marketer" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM marketer m ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_all_patient_admin` ()  NO SQL
BEGIN
	SELECT p.id,p.name,p.tell,p.address,p.age,g.name "gender",m.name "marital",p.date,a.name "admin" FROM patient p INNER JOIN gender g ON g.id=p.gender INNER JOIN marital_status m ON m.id=p.marital_status INNER JOIN users u ON u.id=p.user_id INNER JOIN admin a ON a.id=u.user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_clinicaldata` ()  NO SQL
BEGIN
SELECT c.id `Clinical Data Id`, c.name `Clinical Data`,i.name `image_name`,c.amount, date(c.date) as `Date`, CONCAT('<a href="actions/edit.php?table=clinicaldata&form=sys_forms/frm_addClinicalData.php&sp=sp_insert_clinicalData&id=',c.id,'" data-form-label="Clinical Data" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM clinicaldata c JOIN image i ON i.id = c.image;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_customer` ()  NO SQL
BEGIN
SELECT c.id "Customer ID",c.name"Customer Name",c.mobile_number"Customer Mobile Number",c.type "Customer Type",c.landline_number "Customer Landline Number",c.address "Customer Address",m.name "Marketer",c.max_balance "Maximum Allowed Balance",c.email "Customer email",c.address "Customer Address",c.date,CONCAT('<a href="actions/edit.php?table=customer&form=sys_forms/frm_addCustomer.php&sp=sp_customer&id=',c.id,'" data-form-label="Edit Customer" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM customer c INNER JOIN marketer m ON m.id=c.marketer;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_department` ()  NO SQL
BEGIN
SELECT d.id `Department Id`, d.name `Department Name`, date(d.date) as `Date`, CONCAT('<a href="lib/delete.php?t=department&id=',d.id,'" class="delete btn btn-danger"><i class="icon-trash"></i></a>') as `Delete`,CONCAT('<a href="actions/edit.php?table=department&form=sys_forms/frm_addDepartment.php&sp=sp_department&id=',d.id,'" data-form-label="Edit Department" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM department d ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_designation` ()  NO SQL
BEGIN
SELECT d.id `Designation Id`, d.name `Designation`, date(d.date) as `Date`, CONCAT('<a href="actions/edit.php?table=designation&form=sys_forms/frm_addDesignation.php&sp=sp_designation&id=',d.id,'" data-form-label="Edit Designation" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM designation d ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_diagnosis` ()  NO SQL
BEGIN
SELECT d.id `Diagnosis Id`, d.name `Diagnosis Name`, date(d.date) as `Date`,CONCAT('<a href="actions/edit.php?table=diagnosis&form=sys_forms/frm_addDiagnosis.php&sp=sp_insert_diagnosis&id=',d.id,'" data-form-label="Edit Diagnosis" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM diagnosis d ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_doctor` ()  NO SQL
BEGIN
SELECT d.id `Doctor Id`, if(d.image = 'img/user/','<img src="img/no_img.png" width="48px" height="48px" class="img-circle"/>', CONCAT('<img src="', d.image, '" width="48px" height="48px" class="img-circle"/>' )) `Image`,d.name `Full Name`, d.address `Address`, d.tell `Phone`, dep.name `Department`, s.name `Specialist`, d.office_tell `Office Tell`, g.name `Gender`, b.name `Blood Group`, d.biography `Biography`, date(d.date) as `Date`, CONCAT('<a href="lib/delete.php?t=doctor&id=',d.id,'" class="delete btn btn-danger"><i class="icon-trash"></i></a>') as `Delete`, CONCAT('<a href="lib/edit_form.php?t=doctor&id=',d.id,'" class="btn btn-primary"data-toggle="modal" data-target="#exampleModal"><i class="icon-edit"></i></a>') `Edit` FROM doctor d JOIN department dep on dep.id = d.department JOIN specialist s on s.id = d.specialist JOIN blood_group b ON b.id= d.blood_group JOIN gender g on g.id= d.gender;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_doctors` ()  NO SQL
BEGIN
SELECT d.name `Full Name`, d.address `Address`, d.tell `Phone`, dep.name `Department`, s.name `Specialist`, d.office_tell `Office Tell`, g.name `Gender`, b.name `Blood Group`, d.biography `Biography`, date(d.date) as `Date`, CONCAT('<a href="actions/edit.php?table=doctor&form=sys_forms/frm_addDoctor.php&sp=sp_doctor&id=',d.id,'" data-form-label="Edit Doctor" class="btn btn-primary update_link"><i class="fas fa-trash"></i></a>') `Edit` FROM doctor d JOIN department dep on dep.id = d.department JOIN specialist s on s.id = d.specialist JOIN blood_group b ON b.id= d.blood_group JOIN gender g on g.id= d.gender;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_drug` ()  NO SQL
BEGIN
SELECT d.id `Drug Id`, d.brand_name `Brand Name`, d.generic_name `Generic name`, c.name `Category`, u.name `Unit Measure`, d.unit_value `Unit Value`, d.num_of_pack `Num of Pack`, d.qty_per_pack `Qty Per Pack`, d.qty_on_hand `Qty on Hand`, d.re_oder_qty `Re Oder Qty`,CONCAT('$',d.cost) `Cost`, CONCAT('$',d.price) `Price`, date(d.mfg_date) as `Mfg Date`, date(d.exp_date) as `Exp Date`, date(d.date) as `Date`, CONCAT('<a href="lib/delete.php?t=drug&id=',d.id,'" class="delete btn btn-danger"><i class="icon-trash"></i></a>') as `Delete`, CONCAT('<a href="lib/edit_form.php?t=drug&id=',d.id,'" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="icon-edit"></i></a>') `Edit` FROM drug d JOIN drug_category c on c.id = d.category JOIN unit_measure u on u.id=d.unit_measure;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_drug_category` ()  NO SQL
BEGIN
SELECT d.id `Drug Category Id`, d.name `Drug Category`, date(d.date) as `Date`, CONCAT('<a href="actions/edit.php?table=drug_category&form=sys_forms/frm_addDrugCategory.php&sp=sp_drug_category&id=',d.id,'" data-form-label="Edit Drug Category" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM drug_category d ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_image` ()  NO SQL
BEGIN
SELECT i.id `Image Id`, i.name `Image Name`, date(i.date) as `Date`, CONCAT('<a href="actions/edit.php?table=image&form=sys_forms/frm_addImage.php&sp=sp_image&id=',i.id,'" data-form-label="Edit Image" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM image i ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_invoice_print` (IN `_invoice` INT)  NO SQL
BEGIN
	SELECT DISTINCT(p.sales_type) INTO @sales_type FROM product_sales p WHERE p.invoice_no=_invoice;
    IF @sales_type="cash" THEN
    	SELECT ps.invoice_no,p.brand_name,d.name "category",c.name "country","Cash Sales" AS "sales_type",ps.customer_name,ps.sales_unit,ps.qty,ps.price,ps.amount, DATE_FORMAT(date(ps.date), "%m-%d-%Y") "invoice_date",u.username 
        FROM product_sales ps
        INNER JOIN product_info p ON ps.product_id=p.id
        INNER JOIN sales_invoice_info s ON ps.invoice_no=s.invoice
        INNER JOIN country c ON c.id=p.country
        INNER JOIN users u ON u.id=ps.user_id
        INNER JOIN drug_category d ON d.id=p.category
        WHERE ps.invoice_no=_invoice;
    ELSEIF @sales_type="customer" THEN
    	SELECT ps.invoice_no,p.brand_name,d.name "category",c.name "country","Customer Sales" AS "sales_type",cu.name "customer_name",ps.sales_unit,ps.qty,ps.price,ps.amount,DATE_FORMAT(date(ps.date), "%m-%d-%Y") "invoice_date",u.username 
        FROM product_sales ps
        INNER JOIN product_info p ON ps.product_id=p.id
        INNER JOIN sales_invoice_info s ON ps.invoice_no=s.invoice
        INNER JOIN country c ON c.id=p.country
        INNER JOIN users u ON u.id=ps.user_id
        INNER JOIN drug_category d ON d.id=p.category
        INNER JOIN customer cu ON cu.id=ps.customer_id
        WHERE ps.invoice_no=_invoice;
    ELSEIF @sales_type="prescription" THEN
    	SELECT ps.id,ps.invoice_no,p.brand_name,d.name "category",c.name "country","Prescription Sales" AS "sales_type",pt.name "customer_name",ps.sales_unit ,ps.qty,ps.price,ps.amount,DATE_FORMAT(date(ps.date), "%m-%d-%Y") "invoice_date",u.username 
        FROM product_sales ps
        INNER JOIN product_info p ON ps.product_id=p.id
        INNER JOIN sales_invoice_info s ON ps.invoice_no=s.invoice
        INNER JOIN country c ON c.id=p.country
        INNER JOIN users u ON u.id=ps.user_id
        INNER JOIN drug_category d ON d.id=p.category
        INNER JOIN prescription pr ON pr.prescription_serial=ps.prescription_id
        INNER JOIN patient pt ON pt.id=pr.patient_id
        WHERE ps.invoice_no=_invoice
        GROUP BY ps.id;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_lab` ()  NO SQL
BEGIN
SELECT l.id `Lab Id`, l.name `Lab Name`, date(l.date) as `Date`, CONCAT('<a href="actions/edit.php?table=lab&form=sys_forms/frm_addLab.php&sp=sp_lab&id=',l.id,'" data-form-label="Edit Lab" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM lab l ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_patient_by_doctor` (IN `doctor_id` INT)  NO SQL
BEGIN
	SELECT t.ticket_no `Ticket No`,p.name `Full Name`, g.name `Gender`, p.age `Age`,ps.name `Status`, DATE_FORMAT(date(t.date), "%m-%d-%Y") as `Ticket Date`,CONCAT("<a href='sys_forms/frm_clinicManagement.php?id=",p.id,"&ticket=",t.ticket_no,"&ticket_date=",date(t.date),"' class='patient_visit'><span class='fas fa-check'></span></a>") as "Action" FROM  ticket t JOIN patient p on t.patient_id = p.id JOIN doctor d on d.id = t.doctor JOIN gender g on g.id= d.gender JOIN marital_status m on m.id = p.marital_status JOIN patient_status ps on ps.id = t.p_status WHERE  d.id=doctor_id AND date(t.date)=date(now());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_patient_by_doctor_filter` (IN `doctor_id` INT, IN `patient_id` VARCHAR(10), IN `visit_date` VARCHAR(10))  NO SQL
BEGIN
	SELECT t.ticket_no `Ticket No`,p.name `Full Name`, g.name `Gender`, p.age `Age`,ps.name `Status`, DATE_FORMAT(date(t.date), "%m-%d-%Y") as `Ticket Date`,CONCAT("<a href='sys_forms/frm_clinicManagement.php?id=",p.id,"&ticket=",t.ticket_no,"&ticket_date=",date(t.date),"' class='patient_visit'><span class='fas fa-check'></span></a>") as "Action" FROM  ticket t JOIN patient p on t.patient_id = p.id JOIN doctor d on d.id = t.doctor JOIN gender g on g.id= d.gender JOIN marital_status m on m.id = p.marital_status JOIN patient_status ps on ps.id = t.p_status WHERE  d.id=doctor_id AND date(t.date) LIKE visit_date AND t.patient_id LIKE patient_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_patient_charges` (IN `p_patient_id` INT, IN `p_startdate` DATE, IN `p_enddate` DATE)  NO SQL
BEGIN
SELECT pc.id,pc.tran_no,pc.type,pc.investigation_id,
CASE
    WHEN pc.`type` = 'lab' THEN t.name
    WHEN pc.`type` = 'image' THEN c.name
    WHEN pc.`type` = 'service' THEN s.name
END as `Name / Description`,
pc.amount
FROM
    patient_charge pc 
left JOIN test t ON
    t.id = pc.investigation_id
left JOIN clinicaldata c ON
    c.id = pc.investigation_id
left JOIN service_type s ON
    s.id = pc.investigation_id
WHERE
    pc.patient_id = p_patient_id
    and date(pc.date) BETWEEN date(p_startdate) and date(p_enddate);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_patient_prescription` (IN `_id` INT)  NO SQL
select CASE WHEN  p.quantity < d.qty_on_hand THEN  concat("<input class='drug' type='checkbox' name='drug_id[]' value='",d.id,"'>") END as 'check', concat(d.generic_name,' ',c.name,' ',m.name,' ',d.unit_value) as drug_name,CASE WHEN  p.quantity > d.qty_on_hand THEN "Not Enough" ELSE p.quantity END "qty",round(d.price/d.qty_per_pack,3) as price,CASE WHEN  p.quantity > d.qty_on_hand THEN "Not Enough" ELSE round((d.price/d.qty_per_pack)*p.quantity,2) END as amount,p.prescription_serial as ps FROM prescription p INNER JOIN drug d ON p.drug_id=d.id inner join drug_category c on d.category=c.id INNER JOIN unit_measure m ON m.id=d.unit_measure WHERE p.prescription_serial=_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_patient_single__info` (IN `_id` INT)  NO SQL
BEGIN
	SELECT p.name,p.age,g.name "gender",m.name "marital" FROM patient p INNER JOIN gender g ON g.id=p.gender INNER JOIN marital_status m ON m.id=p.marital_status WHERE p.id=_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_prescription` (IN `p_patient_id` INT)  NO SQL
BEGIN
SELECT  d.`brand_name`, p.`quantity`, p.`frequency`, p.`instruction`,date(p.`date`) as prescription_date,DATE_ADD(date(p.`date`), INTERVAL p.`duration` DAY) as end_date, CONCAT('<input type="checkbox" class="stop" value="',p.id,'"> <i class="fas fa-ban"></i>') as stop FROM `prescription` p JOIN product_info d on p.drug_id=d.id WHERE p.patient_id=p_patient_id and DATE_ADD(date(p.`date`), INTERVAL p.`duration` DAY)  > CURDATE();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_product_info` ()  NO SQL
BEGIN
SELECT p.id "Product ID",p.brand_name "Brand Name",p.generic_name "Generic Name",d.name "Drug Category",p.country "Country",p.preferred_supplier "Prefered Supplier",p.purchase_cost "Purchase cost",p.sell_price "Selling Price",p.mfg_date "Manufacture Date",p.exp_date "Expire Date",p.qty "Quantity",p.date,CONCAT('<a href="actions/edit.php?table=product_info&form=sys_forms/frm_addProduct.php&sp=sp_lab_edit&id=',p.id,'" data-form-label="Edit Product" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM product_info p JOIN drug_category d on p.category = d.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_product_purchase_by_supplier` (IN `_supplier_id` INT)  NO SQL
BEGIN
	SELECT  p.invoice,p.total,p.discount,p.grand_total,p.paid,p.rest,DATE_FORMAT(date(p.date), "%m-%d-%Y") as "date",CONCAT("<a data-form-label='Edit Product Purchases' href='sys_forms/frm_editProductPurchase.php?invoice=",p.invoice,"&supplier=",p.supplier_id,"&date=",date(p.date),"' class='update_link'><span class='fas fa-edit'></span></a>") as "Edit",CONCAT("<a href='sys_forms/frm_CancelproductPurchase.php?invoice=",p.invoice,"&supplier=",p.supplier_id,"&date=",date(p.date),"' class='update_link'><span class='fas fa-times'></span></a>") as "Cancel" FROM purchase_invoice_info p WHERE p.supplier_id=_supplier_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_purchase_invoice_items` (IN `_invoice` INT)  NO SQL
BEGIN
	SELECT pp.id "purchase_id",p.id,s.id "supplier",pp.invoice,pp.purchased_date,p.brand_name,d.name "category",c.name "country",pp.purchase_unit,pp.qty,pp.price,pp.amount FROM product_info p
    INNER JOIN product_purchase pp ON p.id=pp.product_id
    INNER JOIN supplier s ON s.id=pp.supplier_id
    INNER JOIN country c ON c.id=p.country
    INNER JOIN drug_category d ON p.category=d.id
    INNER JOIN purchase_invoice_info pi ON pp.invoice=pi.invoice
    WHERE pp.invoice=_invoice;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_review_symptom` ()  NO SQL
BEGIN
SELECT r.id `Review Symptom Id`, r.name `Review Symptom`, date(r.date) as `Date`, CONCAT('<a href="lib/delete.php?t=review_of_symptoms&id=',r.id,'" class="delete btn btn-danger"><i class="icon-trash"></i></a>') as `Delete`, CONCAT('<a href="lib/edit_form.php?t=review_of_symptoms&id=',r.id,'" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="icon-edit"></i></a>') `Edit` FROM review_of_symptoms r;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_room` ()  NO SQL
BEGIN
SELECT r.room_number `Room Number`, c.name `Room Category`, r.bed `Number of Beds`, d.name `Department`, r.cost `Cost`, date(r.date) as `Date`, CONCAT('<a href="actions/edit.php?table=room&form=sys_forms/frm_addRoom.php&sp=sp_room&id=',r.id,'" data-form-label="Edit Room" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM room r JOIN room_category c on c.id = r.category JOIN department d on d.id = r.dept ORDER BY R.date ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_room_category` ()  NO SQL
BEGIN
SELECT c.id `Room Category Id`, c.name `Room Category`, date(c.date) as `Date`, CONCAT('<a href="actions/edit.php?table=room_category&form=sys_forms/frm_addRoomCategory.php&sp=sp_room_category&id=',c.id,'" data-form-label="Edit Room Category" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM room_category c ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_service` ()  NO SQL
BEGIN
SELECT s.id `Service Id`, s.name `Service Name`, date(s.date) as `Date`, CONCAT('<a href="actions/edit.php?table=services&form=sys_forms/frm_addService.php&sp=sp_service&id=',s.id,'" data-form-label="Edit Services" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM services s ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_service_type` ()  NO SQL
BEGIN 
SELECT st.id as 'ID',s.name as 'Service name',st.name 'Type name',st.amount,date(st.date) date,CONCAT('<a href="actions/edit.php?table=service_type&form=sys_forms/frm_addService_type.php&sp=sp_service_type&id=',st.id,'" data-form-label="Edit Service Type" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` from service_type st JOIN services s on s.id = st.service;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_shift` ()  NO SQL
BEGIN
SELECT s.id `Shift Id`, s.name `Shift`, date(s.date) as `Date`, CONCAT('<a href="actions/edit.php?table=shift&form=sys_forms/frm_addshift.php&sp=sp_shift&id=',s.id,'" data-form-label="Edit Shift" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM shift s ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_specialist` ()  NO SQL
BEGIN
SELECT s.id `Specialist Id`, s.name `Specialist Name`, date(s.date) as `Date`,  CONCAT('<a href="actions/edit.php?table=specialist&form=sys_forms/frm_addSpecialist.php&sp=sp_specialist&id=',s.id,'" data-form-label="Edit Specialist" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM specialist s ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_stuff` ()  NO SQL
BEGIN
SELECT d.id `Stuff Id`, if(d.image = 'img/user/','<img src="img/no_img.png" width="48px" height="48px" class="img-circle"/>', CONCAT('<img src="', d.image, '" width="48px" height="48px" class="img-circle"/>' )) `Image`,d.full_name `Full Name`, d.email `Email`, d.address `Address`, d.tell `Phone`, dep.name `Department`, des.name `Designation`, d.shift `Shift`, d.office_tell `Office Tell`, g.name `Gender`, b.name `Blood Group`, d.biography `Biography`, date(d.date) as `Date`, CONCAT('<a href="lib/delete.php?t=stuff&id=',d.id,'" class="delete btn btn-primary"><i class="icon-trash"></i></a>') as `Delete`, CONCAT('<a href="lib/edit_form.php?t=stuff&id=',d.id,'" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"><i class="icon-edit"></i></a>') `Edit` FROM stuff d JOIN department dep on dep.id = d.department JOIN designation des on des.id = d.designation JOIN blood_group b ON b.id= d.blood_group JOIN gender g on g.id= d.gender;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_supplier` ()  NO SQL
BEGIN
SELECT s.id "Supplier ID",s.name"Supplier Name",s.tell"Supplier Tell",s.email "Supplier email",s.address "Supplier Address",s.date,CONCAT('<a href="actions/edit.php?table=supplier&form=sys_forms/frm_addSupplier.php&sp=sp_supplier&id=',s.id,'" data-form-label="Edit Supplier" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM supplier s ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_test` ()  NO SQL
BEGIN
SELECT t.id `Test Id`, t.name `Tast Name`,l.name `lab_name`,t.amount, date(l.date) as `Date`, CONCAT('<a href="lib/delete.php?t=test&id=',t.id,'" class="delete btn btn-danger"><i class="icon-trash"></i></a>') as `Delete`, CONCAT('<a href="actions/edit.php?table=test&form=sys_forms/frm_addLabTest.php&sp=sp_test&id=',t.id,'" data-form-label="Edit Lab Test" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit` FROM test t JOIN lab l ON l.id = t.lab;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_unit_measure` ()  NO SQL
BEGIN
SELECT u.id `Unit Measure Id`, u.name `Unit Measure`,u.description `Description`, date(u.date) as `Date`,  CONCAT('<a href="actions/edit.php?table=unit_measure&form=sys_forms/frm_addUnitMeasure.php&sp=sp_unit_measure&id=',u.id,'" data-form-label="Edit Shift" class="btn btn-primary update_link"><i class="fas fa-edit"></i></a>') `Edit`  FROM unit_measure u ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_user` ()  NO SQL
BEGIN
SELECT u.id `User Id`, if(u.image = 'img/user/','<img src="img/no_img.png" width="48px" height="48px" class="img-circle"/>', CONCAT('<img src="', u.image, '" width="48px" height="48px" class="img-circle"/>' )) `Image`, u.username `User Name`, u.email `Email`, u.tell `Phone`, date(u.date) as `Date`, CONCAT('<a href="lib/delete.php?t=users&id=',u.id,'" class="delete btn btn-danger"><i class="icon-trash"></i></a>') as `Delete`, CONCAT('<a href="lib/edit_form.php?t=users&id=',u.id,'" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="icon-edit"></i></a>') `Edit` FROM users u ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rp_vital_signs` ()  NO SQL
BEGIN
SELECT v.id `Vital Sign Id`, v.name `Vital Sign`, date(v.date) as `Date`, CONCAT('<a href="lib/delete.php?t=vital_signs&id=',v.id,'" class="delete btn btn-danger"><i class="icon-trash"></i></a>') as `Delete`, CONCAT('<a href="lib/edit_form.php?t=vital_signsy&id=',v.id,'" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="icon-edit"></i></a>') `Edit` FROM vital_signs v ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cash_sales` (IN `_invoice` VARCHAR(50), IN `_customer_name` VARCHAR(50), IN `_product_id` INT, IN `_sales_unit` VARCHAR(50), IN `_qty` FLOAT, IN `_price` FLOAT, IN `_total` FLOAT, IN `_discount` FLOAT, IN `_grand_total` FLOAT, IN `_paid` FLOAT, IN `_rest` FLOAT, IN `_user_id` INT)  NO SQL
BEGIN
START TRANSACTION;
	SELECT p.category INTO @category FROM product_info p WHERE p.id=_product_id;
    IF @category =1 OR @category=2 OR @category=5 THEN
    	SELECT num_strp_per_pack,num_pills_per_pack INTO @stripes, @pills FROM product_info  WHERE id=_product_id;
        	IF _sales_unit="box" THEN
                SET @quantity=_qty*(@stripes*@pills);
            ELSEIF _sales_unit="stripe" THEN
                SET	@quantity=_qty*@pills;
            ELSE
                SET @quantity=_qty;
            END IF; 
	ELSEIF @category=4 THEN
    	SELECT num_inj_per_pack INTO @inj FROM product_info WHERE id=_product_id;
        IF _sales_unit="box" THEN
        	SET @quantity=_qty*@inj;
		ELSE
            SET @quantity=_qty;
        END IF; 
	ELSE
    	SET @quantity=_qty;
    END IF;
	INSERT INTO cash_sales(customer_name,invoice_no,product_id,sales_unit,qty,price,amount,user_id) VALUES(_customer_name,_invoice,_product_id,_sales_unit,_qty,_price,(_qty*_price),_user_id);
	UPDATE product_info SET qty=qty-@quantity WHERE id=_product_id;
	IF NOT EXISTS(SELECT * FROM sales_invoice_info si WHERE si.invoice =_invoice) THEN
        	INSERT INTO sales_invoice_info(invoice,sales_type,total,discount,grand_total,paid,rest,user_id) VALUES(_invoice,"Cash",_total,_discount,_grand_total,_paid,_rest,_user_id);
	END IF;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_change_pass` (IN `_old` VARCHAR(50), IN `_user` INT, IN `_pass` VARCHAR(50), IN `_confirm` VARCHAR(50), IN `_action` VARCHAR(20))  NO SQL
BEGIN

if(_action = 'change') THEN
if not exists(select id from users where id = _user and pass = md5(_old)) THEN

select 'danger|Incorrect Old Password' as msg;


elseif (_pass != _confirm) THEN



select 'danger|Password mis match' as msg;


elseif(_old = _pass) THEN

select 'warning|Old Password and New Password are same' as msg;





else

update users set pass = md5(_pass) where id = _user ;
select 'success|Password Changed' as msg;


end if;


elseif (_action = 'reset') THEN
if (_pass != _confirm) THEN


select 'danger|Password mis match' as msg;

else

update users set pass = md5(_pass) where id = _user ;
select 'success|Password Reset' as msg;

end if;
end if;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_change_password` (IN `_old_password` VARCHAR(50), IN `_new_password` VARCHAR(50), IN `_user_id` INT)  NO SQL
BEGIN
IF EXISTS(SELECT * FROM users u WHERE u.pass=md5(_old_password) and u.id=_user_id) THEN
	UPDATE users SET pass=md5(_new_password) WHERE id=_user_id;
    SELECT "success|Password change successfully";
ELSE
    SELECT "danger|Old password is incorrect please confirm the old password";
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_check_code` (IN `_tell` VARCHAR(50), IN `_code` INT)  NO SQL
BEGIN

if exists(select id from user_code where email = _tell and `code` = _code) THEN

SELECT id into @user from users where email = _tell;

select 'success', @user user_id;

else

select 'error';
end if;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_customer_sales` (IN `_invoice` VARCHAR(50), IN `_customer_id` VARCHAR(50), IN `_product_id` INT, IN `_sales_unit` VARCHAR(50), IN `_qty` FLOAT, IN `_price` FLOAT, IN `_total` FLOAT, IN `_discount` FLOAT, IN `_grand_total` FLOAT, IN `_paid` FLOAT, IN `_rest` FLOAT, IN `_user_id` INT)  NO SQL
BEGIN
START TRANSACTION;
	SELECT p.category INTO @category FROM product_info p WHERE p.id=_product_id;
    IF @category =1 OR @category=2 OR @category=5 THEN
    	SELECT num_strp_per_pack,num_pills_per_pack INTO @stripes, @pills FROM product_info  WHERE id=_product_id;
        	IF _sales_unit="box" THEN
                SET @quantity=_qty*(@stripes*@pills);
            ELSEIF _sales_unit="stripe" THEN
                SET	@quantity=_qty*@pills;
            ELSE
                SET @quantity=_qty;
            END IF; 
	ELSEIF @category=4 THEN
    	SELECT num_inj_per_pack INTO @inj FROM product_info WHERE id=_product_id;
        IF _sales_unit="box" THEN
        	SET @quantity=_qty*@inj;
		ELSE
            SET @quantity=_qty;
        END IF; 
	ELSE
    	SET @quantity=_qty;
    END IF;
    IF NOT EXISTS(SELECT * FROM customer_sales c WHERE c.customer_id=_customer_id  AND c.invoice_no=_invoice) THEN
    	INSERT INTO customer_sales(sales_type,customer_id,invoice_no,product_id,sales_unit,qty,price,amount,user_id) VALUES("Customer Sales",_customer_id,_invoice,_product_id,_sales_unit,_qty,_price,(_qty*_price),_user_id);
        UPDATE product_info SET qty=qty-@quantity WHERE id=_product_id;
        IF NOT EXISTS(SELECT * FROM sales_invoice_info si WHERE si.invoice =_invoice) THEN
        	INSERT INTO sales_invoice_info(invoice,sales_type,total,discount,grand_total,paid,rest,user_id) VALUES(_invoice,"Customer",_total,_discount,_grand_total,_paid,_rest,_user_id);
            IF _rest <> 0 THEN
            	UPDATE account_receivable SET amount=amount+_rest WHERE id=_customer_id;
            END IF;
        END IF;
    ELSE
    	SELECT "Exists" msg;
    END IF;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_department` (IN `p_id` INT, IN `department_name` VARCHAR(50), IN `user_id` INT)  NO SQL
BEGIN 
if EXISTS(select d.id from department d where d.id = p_id) then
UPDATE department d set d.name = department_name WHERE d.id = p_id;
SELECT concat('success|Department ',department_name,' Sucessfuly Updated') msg;
ELSEIF EXISTS(SELECT name FROM department WHERE name=department_name) THEN
SELECT concat('warning|',department_name,' Already Exist') msg;
ELSE
INSERT INTO department(name,user_id) VALUES(department_name,user_id);
SELECT concat('success|Department ',department_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_designation` (IN `p_des_name` VARCHAR(50), IN `p_des_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT id from designation WHERE id = p_id) THEN
UPDATE designation d set d.name =p_des_name WHERE d.id = p_id;
SELECT concat('success|',p_des_name,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM designation WHERE name=p_des_name) THEN
SELECT concat('warning|',p_des_name,' Already Exist') msg;
ELSE
INSERT INTO designation(name,user_id) VALUES(p_des_name,p_des_user_id);
SELECT concat('success|',p_des_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_doctor` (IN `P_Full_Name` VARCHAR(100), IN `p_tell` VARCHAR(50), IN `p_email` VARCHAR(50), IN `p_address` VARCHAR(50), IN `p_img` VARCHAR(200), IN `p_department` VARCHAR(50), IN `p_specialist` VARCHAR(50), IN `p_biography` VARCHAR(200), IN `p_office_tell` VARCHAR(50), IN `p_gender` VARCHAR(50), IN `p_blood_group` VARCHAR(50), IN `p_ticket` FLOAT, IN `p_username` VARCHAR(50), IN `p_password` VARCHAR(50), IN `p_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
START TRANSACTION;
IF EXISTS(SELECT d.id from doctor d WHERE d.id = p_id) THEN
	UPDATE doctor d set d.name =p_Full_Name,d.email = p_email,d.address=p_address,d.tell=p_tell,d.department=p_department,d.specialist=p_specialist,d.office_tell=p_office_tell,d.gender=p_gender,d.blood_group=p_blood_group,d.biography=p_biography,d.ticket_cost=p_ticket WHERE d.id = p_id;
UPDATE users set username=p_username,pass=md5(p_password),Image=p_img WHERE users.user_id=p_id AND users.usertype=2;
SELECT concat('success|Dr ',p_Full_Name,' Sucessfuly Updated') msg;
    
ELSEIF EXISTS(SELECT username FROM users WHERE username=p_username) THEN
	SELECT concat('warning| Username Already Exist') msg;
ELSEIF EXISTS(SELECT * FROM doctor d WHERE d.name=p_Full_Name AND (d.email=p_email OR d.tell=p_tell)) THEN
	SELECT concat('warning|Doctor Already Exist') msg;
ELSE
	INSERT INTO doctor(name,email,address,tell,department,specialist,office_tell,gender,blood_group,biography,ticket_cost,user_id) VALUES(p_full_name,p_email,p_address,p_tell,p_department,p_specialist,p_office_tell,p_gender,p_blood_group,p_biography,p_ticket,p_user_id);
	SELECT MAX(id) into @id FROM doctor;
    UPDATE users set username=p_username,pass=md5(p_password),Image=p_img WHERE users.user_id=@id AND users.usertype=2;
	SELECT concat('success|Dr ',p_Full_Name,' Sucessfuly Registered') msg;
END IF;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_drug` (IN `drug_brand_name` VARCHAR(50), IN `drug_generic_name` VARCHAR(50), IN `drug_category` INT, IN `drug_unit_measure` INT, IN `drug_unit_value` VARCHAR(50), IN `drug_num_of_pack` INT, IN `drug_qty_per_pack` INT, IN `drug_qty_on_hand` INT, IN `drug_re_oder_qty` INT, IN `drug_cost` FLOAT, IN `drug_price` FLOAT, IN `drug_mfg_date` DATE, IN `drug_exp_date` DATE, IN `user_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT * FROM drug d WHERE d.brand_name=drug_brand_name AND d.generic_name=drug_generic_name AND d.category=drug_category AND d.unit_measure=drug_unit_measure AND d.unit_value=drug_unit_value) THEN
	SELECT "warning| This drug is already registered" msg;
ELSE
	INSERT INTO drug(brand_name,generic_name,category,unit_measure,unit_value,num_of_pack,qty_per_pack,qty_on_hand,re_oder_qty,cost,price,mfg_date,exp_date,user_id) VALUES(drug_brand_name,drug_generic_name,drug_category,drug_unit_measure,drug_unit_value,drug_num_of_pack,drug_qty_per_pack,drug_qty_on_hand,drug_re_oder_qty,drug_cost,drug_price,drug_mfg_date,drug_exp_date,user_id);
SELECT concat('success|',drug_generic_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_drug_category` (IN `drug_category_name` VARCHAR(50), IN `user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT id FROM drug_category WHERE id = p_id) THEN
UPDATE drug_category d set d.name = drug_category_name WHERE d.id = p_id;
SELECT concat('success|',drug_category_name,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM drug_category WHERE name=drug_category_name) THEN
SELECT concat('warning|',drug_category_name,' Already Exist') msg;
ELSE
INSERT INTO drug_category(name,user_id) VALUES(drug_category_name,user_id);
SELECT concat('success|',drug_category_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_image` (IN `image_name` VARCHAR(50), IN `image_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT id FROM image i WHERE i.id = p_id) THEN
UPDATE image i set i.name = image_name WHERE i.id = p_id;
SELECT concat('success|',image_name,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM image WHERE name=image_name) THEN
SELECT concat('warning|',image_name,' Already Exist') msg;
ELSE
INSERT INTO image(name,user_id) VALUES(image_name,image_user_id);
SELECT concat('success|',image_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_clinicalData` (IN `clinicalData_image` INT, IN `clinicalData_name` VARCHAR(50), IN `clinicalData_amount` FLOAT, IN `clinicalData_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT id from clinicalData WHERE id = p_id) THEN
UPDATE clinicalData c set c.image = clinicalData_image,c.name = clinicalData_name,c.amount=clinicalData_amount WHERE c.id = p_id;
SELECT concat('success|',clinicalData_name,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM clinicalData WHERE name=clinicalData_name) THEN
SELECT concat('warning|',clinicalData_name,' Already Exist') msg;
ELSE
INSERT INTO clinicalData(image,name,amount,user_id) VALUES(clinicalData_image,clinicalData_name,clinicalData_amount,clinicalData_user_id);
SELECT concat('success|',clinicalData_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_diagnosis` (IN `p_id` INT, IN `p_name` VARCHAR(200), IN `p_user_id` INT)  NO SQL
BEGIN
IF EXISTS(SELECT d.id FROM diagnosis d WHERE d.id = p_id) THEN
UPDATE diagnosis d set d.name =p_name WHERE d.id = p_id;
 SELECT "success|Diagnosis successfully Updated" msg;
ELSEIF EXISTS(SELECT * FROM diagnosis WHERE name=p_name) THEN
	SELECT "warning|This diagnosis already registered" msg;
ELSE
	INSERT INTO diagnosis(name,user_id) VALUES(p_name,p_user_id);
    SELECT "success|Diagnosis successfully registered" msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_history_taken` (IN `_cheif_complaint` TEXT, IN `_history_present_illness` TEXT, IN `_past_medical_history` TEXT, IN `_drug_history` TEXT, IN `_allergies` TEXT, IN `_family_hsitory` TEXT, IN `_social_history` TEXT, IN `_obs_gyne_history` TEXT, IN `_patient_id` INT, IN `_ticket_no` INT, IN `_visit_date` DATE, IN `_doctor_id` INT, IN `_user_id` INT)  NO SQL
BEGIN
IF NOT EXISTS(SELECT * FROM history_taking h WHERE h.patient_id=_patient_id AND h.visit_date=_visit_date AND h.doctor_id=_doctor_id) THEN
	INSERT INTO history_taking(patient_id,ticket_no,visit_date,doctor_id,cheif_complaint,history_present_illness,past_medical_history,drug_history,allergies,family_hsitory,social_history,obs_gyne_history,user_id) VALUES(_patient_id,_ticket_no,_visit_date,_doctor_id,_cheif_complaint,_history_present_illness,_past_medical_history,_drug_history,_allergies,_family_hsitory,_social_history,_obs_gyne_history,_user_id);
ELSE
	SELECT h.cheif_complaint,h.history_present_illness INTO @cheif,@history FROM history_taking h WHERE h.patient_id=_patient_id AND h.visit_date=_visit_date AND h.doctor_id=_doctor_id;
    IF @cheif ="" OR  @history="" THEN
    	UPDATE history_taking SET cheif_complaint=_cheif_complaint,history_present_illness=_history_present_illness,past_medical_history=_past_medical_history,drug_history=_drug_history,allergies=_allergies,family_hsitory=_family_hsitory,social_history=_social_history,obs_gyne_history=_obs_gyne_history WHERE patient_id=_patient_id AND visit_date=_visit_date AND doctor_id=_doctor_id;
    END IF;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_image_request` (IN `p_patient_id` INT, IN `p_ticket_no` INT, IN `p_visit_date` DATE, IN `p_doctor_id` INT, IN `p_image_test_id` INT, IN `p_user_id` INT)  NO SQL
BEGIN 
START TRANSACTION;

SELECT `value` into @image_tran_no FROM `setup` WHERE  id=5;

INSERT INTO `image_request`(`image_tran_no`, `patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `image_test_id`, `image_status`,`user_id`)
VALUES(@image_tran_no,p_patient_id,p_ticket_no,p_visit_date,p_doctor_id,p_image_test_id,'Ordered',p_user_id);
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_lab_request` (IN `p_patient_id` INT, IN `p_ticket_no` INT, IN `p_visit_date` DATE, IN `p_doctor_id` INT, IN `p_lab_test_id` INT, IN `p_user_id` INT)  NO SQL
BEGIN 
START TRANSACTION;

SELECT `value` into @lab_tran_no FROM `setup` WHERE  id=3;

INSERT INTO `lab_request`(`lab_tran_no`,`patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `lab_test_id`, `lab_status`,`user_id`)
VALUES(@lab_tran_no,p_patient_id,p_ticket_no,p_visit_date,p_doctor_id,p_lab_test_id,'Ordered',p_user_id);
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_patient_diagnosis` (IN `p_patient_id` INT, IN `p_ticket_no` INT, IN `p_visit_date` DATE, IN `p_doctor_id` INT, IN `p_diagnosis_id` INT, IN `p_diagnosis_type` VARCHAR(50), IN `p_user_id` INT)  NO SQL
BEGIN 
START TRANSACTION;

SELECT `value` into @diagnosis_tran_no FROM `setup` WHERE  id=7;

INSERT INTO `patient_diagnosis`(`diagnosis_tran_no`, `patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `diagnosis_id`,`diagnosis_type`,`user_id`)
VALUES(@diagnosis_tran_no,p_patient_id,p_ticket_no,p_visit_date,p_doctor_id,p_diagnosis_id,p_diagnosis_type,p_user_id);
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_physical_examination` (IN `_appearance` TEXT, IN `_temperature` VARCHAR(50), IN `_pulse_rate` VARCHAR(50), IN `_respiratory_rate` VARCHAR(50), IN `_blood_pressure` VARCHAR(50), IN `_weight` FLOAT, IN `_height` FLOAT, IN `_bmi` FLOAT, IN `_patient_id` INT, IN `_ticket_no` INT, IN `_visit_date` DATE, IN `_doctor_id` INT, IN `_user_id` INT)  NO SQL
BEGIN
IF NOT EXISTS(SELECT * FROM physical_examination p WHERE p.patient_id=_patient_id AND p.visit_date=_visit_date AND p.doctor_id=_doctor_id) THEN
	INSERT INTO physical_examination(patient_id,ticket_no,visit_date,doctor_id,appearance,temperature,pulse_rate,respiratory_rate,blood_pressure,weight,height,bmi,user_id) VALUES(_patient_id,_ticket_no,_visit_date,_doctor_id,_appearance,_temperature,_pulse_rate,_respiratory_rate,_blood_pressure,_weight,_height,_bmi,_user_id);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_prescription` (IN `p_patient_id` INT, IN `p_ticket_no` INT, IN `p_visit_date` DATE, IN `p_doctor_id` INT, IN `p_drug_id` INT, IN `p_quantity` INT, IN `p_frequency` VARCHAR(50), IN `p_duration` VARCHAR(50), IN `p_instruction` TEXT, IN `p_user_id` INT)  NO SQL
BEGIN 
START TRANSACTION;

SELECT `value` into @prescription_serial FROM `setup` WHERE  id=1;

INSERT INTO `prescription`(`prescription_serial`, `patient_id`, `ticket_no`,`visit_date`, `doctor_id`, `drug_id`, `quantity`, `frequency`,`duration`, `instruction`, `user_id`)
VALUES(@prescription_serial,p_patient_id,p_ticket_no,p_visit_date,p_doctor_id,p_drug_id,p_quantity,p_frequency,p_duration,p_instruction,p_user_id);
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_service_request` (IN `p_patient_id` INT, IN `p_ticket_no` INT, IN `p_visit_date` DATE, IN `p_doctor_id` INT, IN `p_service_test_id` INT, IN `p_user_id` INT)  NO SQL
BEGIN 
START TRANSACTION;

SELECT `value` into @service_tran_no FROM `setup` WHERE  id=6;

INSERT INTO `services_request`(`service_tran_no`, `patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `service_test_id`, `service_status`,`user_id`)
VALUES(@service_tran_no,p_patient_id,p_ticket_no,p_visit_date,p_doctor_id,p_service_test_id,'Ordered',p_user_id);
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_interface_design` (IN `_usertype` INT, IN `_id` VARCHAR(20))  NO SQL
BEGIN
IF _usertype=1 THEN
	SELECT a.name into @name FROM admin a INNER JOIN users u on a.id=u.user_id where u.id=_id;
	SELECT u.username,SUBSTRING_INDEX(@name," ",2) as name,u.Image as img, t.name usertype FROM admin a INNER JOIN users u on a.id=u.user_id INNER JOIN usertype t on u.usertype=t.id where u.id=_id;
ELSEIF _usertype=2 THEN
	SELECT d.name into @name FROM doctor d INNER JOIN users u ON u.user_id=d.id where u.id=_id;
	SELECT u.username,SUBSTRING_INDEX(@name," ",2) as name,u.Image as img, t.name usertype FROM doctor d INNER JOIN users u on d.id=u.user_id INNER JOIN usertype t on u.usertype=t.id where u.id=_id;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lab` (IN `lab_name` VARCHAR(50), IN `lab_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT id FROM lab l WHERE l.id = p_id) THEN
UPDATE lab l set l.name = lab_name WHERE l.id = p_id;
SELECT concat('success|',lab_name,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM lab WHERE name=lab_name) THEN
SELECT concat('warning|',lab_name,' Already Exist') msg;
ELSE
INSERT INTO lab(name,user_id) VALUES(lab_name,lab_user_id);
SELECT concat('success|',lab_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lab_request` (IN `lab_patient` INT, IN `lab_tell` VARCHAR(50), IN `lab_note` VARCHAR(200), IN `lab_doctor` INT, IN `lab_req_exam` INT, IN `lab_user_id` INT)  NO SQL
BEGIN 
INSERT INTO lab_request(`patient`, `tell`, `note`, `doctor`, `lab_exam`, `user_id`) VALUES(lab_patient,lab_tell,lab_note,lab_doctor,lab_req_exam,lab_user_id);
SELECT concat('success| Sucessfuly Inserted') msg;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login` (IN `_username` VARCHAR(50), IN `_password` VARCHAR(50))  NO SQL
BEGIN
IF EXISTS(SELECT * FROM users WHERE username=_username and pass=md5(_password)) THEN
	SELECT usertype INTO @usertype FROM users WHERE username=_username and pass=md5(_password);
    IF @usertype=1 THEN
    	SELECT u.id,a.id "user_id",a.name,a.email,u.username,u.usertype,"success" msg FROM users u INNER JOIN admin a on u.user_id=a.id  WHERE username=_username and pass=md5(_password);
    ELSEIF @usertype=2 THEN
    	SELECT u.id,d.id "user_id",d.name,d.email,u.username,u.usertype,"success" msg FROM users u INNER JOIN doctor d on u.user_id=d.id  WHERE username=_username and pass=md5(_password);
    END IF;
ELSE
	SELECT "Username or password is incorrect" msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_marketer` (IN `_name` VARCHAR(50), IN `_tel` VARCHAR(50), IN `_email` VARCHAR(50), IN `_address` VARCHAR(50), IN `_user_id` INT, IN `_id` INT)  NO SQL
BEGIN
	IF EXISTS(SELECT * FROM marketer WHERE id=_id) THEN
    	UPDATE marketer m SET m.name=_name,m.tel=_tel,m.email=_email,m.address=_address WHERE m.id=_id;
        SELECT "success|Marketer successfully updated" msg;
    ELSEIF	EXISTS(SELECT * FROM marketer m WHERE m.tel=_tel OR m.email=_email) THEN
    	SELECT "warning|Marketer already registered" msg;
    ELSE
    	INSERT INTO marketer(name,tel,email,address,user_id) VALUES(_name,_tel,_email,_address,_user_id);
        SELECT "success|Marketer successfully registered" msg;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_menu` (IN `_href` VARCHAR(100), IN `_text` VARCHAR(100), IN `_icon` VARCHAR(100), IN `_menu` VARCHAR(100), IN `_menu_icon` VARCHAR(100), IN `_user_id` INT)  NO SQL
BEGIN 

if EXISTS(SELECT text FROM sidebar s WHERE s.text=_text) THEN
SELECT concat('danger|',_text,' Already Exist') msg;

ELSE
INSERT INTO sidebar(href,text,icon,menu,menu_icon,user_id) VALUES(_href,_text,_icon,_menu,_menu_icon,_user_id);
SELECT concat('success|',_text,' Sucessfuly Registered') msg;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_patient` (IN `patient_full_name` VARCHAR(100), IN `patient_tell` VARCHAR(50), IN `patient_address` VARCHAR(50), IN `patient_gender` VARCHAR(50), IN `patient_age` INT, IN `patient_marital_status` INT, IN `patient_doctor` INT, IN `patient_cost` FLOAT, IN `patiend_user_id` INT)  NO SQL
BEGIN 
START TRANSACTION;
IF EXISTS(SELECT * FROM patient p WHERE p.name=patient_full_name AND p.tell=patient_tell) THEN
	SELECT concat('warning|This patient ',patient_full_name,' already registered') msg;
ELSE
	SELECT CASE WHEN ticket_no is null THEN  1 ELSE max(ticket_no)+1 END into @ticket FROM ticket WHERE doctor = patient_doctor and DATE(date) = DATE(NOW());
	SELECT CASE WHEN id is null THEN  1 ELSE max(id)+1 END into @p_id FROM patient;
    IF EXISTS(SELECT * FROM ticket t WHERE t.patient_id=@p_id AND t.doctor=patient_doctor AND date(t.date)=date(now())) THEN
		SELECT concat('warning|This patient already has ',t.ticket_no," ticket No") msg FROM ticket t WHERE t.patient_id=p_id AND t.doctor=doctor_id AND date(t.date)=date(now());
    ELSE
		INSERT INTO patient(name,tell,address,gender,age,marital_status,user_id) VALUES(patient_full_name,patient_tell,patient_address,patient_gender,patient_age,patient_marital_status,patiend_user_id);

		INSERT INTO ticket(ticket_no,patient_id,doctor,cost,p_status,user_id) VALUES(@ticket,@p_id,patient_doctor,patient_cost,1,patiend_user_id);  
		SELECT concat('success|Patient ',patient_full_name,' Sucessfuly Registered') msg;
    END IF;
END IF;	
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_permission` (IN `_user` INT, IN `_sidebar` INT, IN `_action` VARCHAR(50))  NO SQL
BEGIN

if (_action = 'grant') THEN

insert into permission (user_id,sidebar_id) values (_user,_sidebar);

else

delete from permission where user_id = _user  and sidebar_id = _sidebar;

end if;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_permissions` (IN `_user` INT, IN `_sidebar` INT, IN `_action` VARCHAR(50))  NO SQL
BEGIN

if (_action = 'grant') THEN

insert into permission (user_id,sidebar_id) values (_user,_sidebar);

else

delete from permission where user_id = _user  and sidebar_id = _sidebar;

end if;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_pharmacy_sales` (IN `_invoice_id` INT, IN `_drug_id` INT, IN `_prescription_id` INT, IN `_quantity` INT, IN `_user_id` INT)  NO SQL
BEGIN
START TRANSACTION;
INSERT INTO pharmacy_sales(invoice_id,drug_id,prescription_id,quantity,user_id) VALUES(_invoice_id,_drug_id,_prescription_id,_quantity,_user_id);

UPDATE drug setup set qty_on_hand=qty_on_hand-_quantity WHERE id=_drug_id;

UPDATE setup set setup.value=setup.value+1 WHERE setup.name="invoice";
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_prescription` (IN `pr_patient_id` INT, IN `pr_doctor_id` INT, IN `pr_serial` VARCHAR(50), IN `pr_drug_id` INT, IN `pr_quantity` INT, IN `pr_frequency` VARCHAR(10), IN `pr_instruction` TEXT, IN `pr_user_id` INT)  NO SQL
BEGIN
	INSERT INTO prescription(patient_id,doctor_id,prescription_serial,drug_id	,quantity,frequency,instruction,user_id) VALUES(pr_patient_id,pr_doctor_id,pr_serial,pr_drug_id,pr_quantity,pr_frequency,pr_instruction,pr_user_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_prescription_patient` (IN `_p_id` INT)  NO SQL
SELECT DISTINCT(pt.id),pt.name,g.name AS gender,pt.age FROM patient pt INNER JOIN prescription p on pt.id=p.patient_id inner join gender g on pt.gender =g.id WHERE p.prescription_serial=_p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_prescription_sales` (IN `_invoice` VARCHAR(50), IN `_prescription` VARCHAR(50), IN `_product_id` INT, IN `_sales_unit` VARCHAR(50), IN `_qty` FLOAT, IN `_price` FLOAT, IN `_total` FLOAT, IN `_discount` FLOAT, IN `_grand_total` FLOAT, IN `_paid` FLOAT, IN `_rest` FLOAT, IN `_user_id` INT)  NO SQL
BEGIN
START TRANSACTION;
	SELECT p.category INTO @category FROM product_info p WHERE p.id=_product_id;
    IF @category =1 OR @category=2 OR @category=5 THEN
    	SELECT num_strp_per_pack,num_pills_per_pack INTO @stripes, @pills FROM product_info  WHERE id=_product_id;
        	IF _sales_unit="box" THEN
                SET @quantity=_qty*(@stripes*@pills);
            ELSEIF _sales_unit="stripe" THEN
                SET	@quantity=_qty*@pills;
            ELSE
                SET @quantity=_qty;
            END IF; 
	ELSEIF @category=4 THEN
    	SELECT num_inj_per_pack INTO @inj FROM product_info WHERE id=_product_id;
        IF _sales_unit="box" THEN
        	SET @quantity=_qty*@inj;
		ELSE
            SET @quantity=_qty;
        END IF; 
	ELSE
    	SET @quantity=_qty;
    END IF;
	INSERT INTO prescription_sales(prescription_id,invoice_no,product_id,sales_unit,qty,price,amount,user_id) VALUES(_prescription,_invoice,_product_id,_sales_unit,_qty,_price,(_qty*_price),_user_id);
	UPDATE product_info SET qty=qty-@quantity WHERE id=_product_id;
	IF NOT EXISTS(SELECT * FROM sales_invoice_info si WHERE si.invoice =_invoice) THEN
        	INSERT INTO sales_invoice_info(invoice,sales_type,total,discount,grand_total,paid,rest,user_id) VALUES(_invoice,"Prescription",_total,_discount,_grand_total,_paid,_rest,_user_id);
	END IF;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_product_purchase` (IN `_id` INT, IN `_supplier_id` INT, IN `_invoice` VARCHAR(50), IN `_purchase_date` DATE, IN `_product_id` INT, IN `_purchase_unit` VARCHAR(50), IN `_qty` FLOAT, IN `_price` FLOAT, IN `_total` FLOAT, IN `_discount` FLOAT, IN `_grand_total` FLOAT, IN `_paid` FLOAT, IN `_rest` FLOAT, IN `_user_id` INT)  NO SQL
BEGIN
START TRANSACTION;
    #update part
    IF EXISTS(SELECT * FROM product_purchase p WHERE p.id=_id) THEN
        SELECT p.category,pp.purchase_unit,pp.qty INTO @category,@purchase_unit,@qty FROM product_info p INNER JOIN product_purchase pp ON p.id=pp.product_id WHERE p.id=_product_id AND pp.id=_id;
        IF @category =1 OR @category =2 OR @category =5 THEN
            SELECT num_strp_per_pack,num_pills_per_pack INTO @stripes, @pills FROM product_info  WHERE id=_product_id;
            IF @purchase_unit="box" THEN
                SET @quantity=@qty*(@stripes*@pills);
            ELSEIF @purchase_unit="stripe" THEN
                SET @quantity=@qty*@pills;
            ELSE
                SET @quantity=@qty;
            END IF;  
        ELSEIF @category =4 THEN
            SELECT num_inj_per_pack INTO @inj FROM product_info  WHERE id=_product_id;
            IF @purchase_unit="box" THEN
                SET @quantity=@qty*@inj;
            ELSE
                SET @quantity=@qty;
            END IF;  
        ELSE
            SET @quantity=@qty;
        END IF;
        UPDATE product_info SET qty=qty-@quantity WHERE id=_product_id;
        SELECT rest INTO @rest FROM purchase_invoice_info WHERE invoice =_invoice;
        UPDATE account_payable SET amount=amount-@rest WHERE supplier_id=_supplier_id;
        UPDATE product_purchase SET
            supplier_id=_supplier_id,
            invoice=_invoice,
            product_id=_product_id,
            purchase_unit=_purchase_unit,
            qty=_qty,
            price=_price,
            amount=_qty*_price,
            purchased_date=_purchase_date
        WHERE id=_id;
        SELECT p.category INTO @category FROM product_info p WHERE p.id=_product_id;
        IF @category =1 OR @category =2 OR @category =5 THEN
            SELECT num_strp_per_pack,num_pills_per_pack INTO @stripes, @pills FROM product_info  WHERE id=_product_id;
            IF _purchase_unit="box" THEN
                SET @quantity=_qty*(@stripes*@pills);
            ELSEIF _purchase_unit="stripe" THEN
                SET @quantity=_qty*@pills;
            ELSE
                SET @quantity=_qty;
            END IF;  
        ELSEIF @category =4 THEN
            SELECT num_inj_per_pack INTO @inj FROM product_info  WHERE id=_product_id;
            IF _purchase_unit="box" THEN
                SET @quantity=_qty*@inj;
            ELSE
                SET @quantity=_qty;
            END IF;  
        ELSE
            SET @quantity=_qty;
        END IF;
        UPDATE product_info SET qty=qty+@quantity WHERE id=_product_id;
        UPDATE purchase_invoice_info SET
            supplier_id=_supplier_id,
            invoice=_invoice,
            total=_total,
            discount=_discount,
            grand_total=_grand_total,
            paid=_paid,
            rest=_rest
        WHERE invoice=_invoice;
        IF _rest > 0 THEN
            UPDATE account_payable SET amount=amount+_rest WHERE id=_supplier_id;
        END IF;
    ELSE
        SELECT p.category INTO @category FROM product_info p WHERE p.id=_product_id;
        IF @category =1 OR @category =2 OR @category =5 THEN
            SELECT num_strp_per_pack,num_pills_per_pack INTO @stripes, @pills FROM product_info  WHERE id=_product_id;
            IF _purchase_unit="box" THEN
                SET @quantity=_qty*(@stripes*@pills);
            ELSEIF _purchase_unit="stripe" THEN
                SET @quantity=_qty*@pills;
            ELSE
                SET @quantity=_qty;
            END IF;  
        ELSEIF @category =4 THEN
            SELECT num_inj_per_pack INTO @inj FROM product_info  WHERE id=_product_id;
            IF _purchase_unit="box" THEN
                SET @quantity=_qty*@inj;
            ELSE
                SET @quantity=_qty;
            END IF;  
        ELSE
            SET @quantity=_qty;
        END IF;
        IF NOT EXISTS(SELECT * FROM product_purchase p WHERE p.supplier_id=_supplier_id AND p.invoice=_invoice AND date(p.date) <> date(now())) THEN
            INSERT INTO product_purchase(supplier_id,invoice,product_id,purchase_unit,qty,price,amount,purchased_date,user_id) VALUES(_supplier_id,_invoice,_product_id,_purchase_unit,_qty,_price,(_qty*_price),_purchase_date,_user_id);
            UPDATE product_info SET qty=qty+@quantity WHERE id=_product_id;
            IF NOT EXISTS(SELECT * FROM purchase_invoice_info pi WHERE pi.invoice =_invoice) THEN
                INSERT INTO purchase_invoice_info(supplier_id,invoice,total,discount,grand_total,paid,rest,user_id) VALUES(_supplier_id,_invoice,_total,_discount,_grand_total,_paid,_rest,_user_id);
                IF _rest > 0 THEN
                    UPDATE account_payable SET amount=amount+_rest WHERE id=_supplier_id;
                END IF;
            END IF;
        END IF;
    END IF;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_product_registration` (IN `_brand_name` VARCHAR(200), IN `_generic_name` VARCHAR(100), IN `_country` INT, IN `_category` INT, IN `_preferred_supplier` INT, IN `_purchase_cost` FLOAT, IN `_sell_price` FLOAT, IN `_mfg_date` DATE, IN `_exp_date` DATE, IN `_user_id` INT)  NO SQL
BEGIN
IF EXISTS(SELECT * from product_info p WHERE p.brand_name=_brand_name AND p.generic_name=_generic_name AND p.category=_category AND p.country=_country AND p.mfg_date=_mfg_date AND p.exp_date=_exp_date) THEN
	SELECT "warning| This product is already registered" msg;
ELSE
	INSERT INTO product_info(brand_name,generic_name,category,country,preferred_supplier,purchase_cost,sell_price,mfg_date,exp_date,user_id) VALUES (_brand_name,_generic_name,_category,_country,_preferred_supplier,_purchase_cost,_sell_price,_mfg_date,_exp_date,_user_id);
    SELECT "success| Product successfully registered" msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_product_registration_inj` (IN `_brand_name` VARCHAR(200), IN `_generic_name` VARCHAR(100), IN `_country` INT, IN `_category` INT, IN `_num_inj_per_pack` INT, IN `_preferred_supplier` INT, IN `_purchase_cost` FLOAT, IN `_sell_price` FLOAT, IN `_mfg_date` DATE, IN `_exp_date` DATE, IN `_user_id` INT)  NO SQL
BEGIN
IF EXISTS(SELECT * from product_info p WHERE p.brand_name=_brand_name AND p.generic_name=_generic_name AND p.category=_category AND p.country=_country AND p.mfg_date=_mfg_date AND p.exp_date=_exp_date) THEN
	SELECT "warning| This product is already registered" msg;
ELSE
	INSERT INTO product_info(brand_name,generic_name,category,country,num_inj_per_pack,preferred_supplier,purchase_cost,sell_price,mfg_date,exp_date,user_id) VALUES (_brand_name,_generic_name,_category,_country,_num_inj_per_pack,_preferred_supplier,_purchase_cost,_sell_price,_mfg_date,_exp_date,_user_id);
    SELECT "success| Product successfully registered" msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_product_registration_pills` (IN `_brand_name` VARCHAR(200), IN `_generic_name` VARCHAR(100), IN `_country` INT, IN `_category` INT, IN `_num_strp_per_pack` INT, IN `_num_pills_per_pack` INT, IN `_preferred_supplier` INT, IN `_purchase_cost` FLOAT, IN `_sell_price` FLOAT, IN `_mfg_date` DATE, IN `_exp_date` DATE, IN `_user_id` INT)  NO SQL
BEGIN
IF EXISTS(SELECT * from product_info p WHERE p.brand_name=_brand_name AND p.generic_name=_generic_name AND p.category=_category AND p.country=_country AND p.mfg_date=_mfg_date AND p.exp_date=_exp_date) THEN
	SELECT "warning| This product is already registered" msg;
ELSE
	INSERT INTO product_info(brand_name,generic_name,category,country,num_strp_per_pack,num_pills_per_pack,preferred_supplier,purchase_cost,sell_price,mfg_date,exp_date,user_id) VALUES (_brand_name,_generic_name,_category,_country,_num_strp_per_pack,_num_pills_per_pack,_preferred_supplier,_purchase_cost,_sell_price,_mfg_date,_exp_date,_user_id);
    SELECT "success| Product successfully registered" msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_product_sales` (IN `_invoice` VARCHAR(50), IN `_type` VARCHAR(50), IN `_customer_name` VARCHAR(50), IN `_customer_id` VARCHAR(50), IN `_prescription` VARCHAR(10), IN `_product_id` INT, IN `_sales_unit` VARCHAR(50), IN `_qty` FLOAT, IN `_price` FLOAT, IN `_total` FLOAT, IN `_discount` FLOAT, IN `_grand_total` FLOAT, IN `_paid` FLOAT, IN `_rest` FLOAT, IN `_user_id` INT)  NO SQL
BEGIN
START TRANSACTION;
	SELECT p.category INTO @category FROM product_info p WHERE p.id=_product_id;
    IF @category =1 OR @category=2 OR @category=5 THEN
    	SELECT num_strp_per_pack,num_pills_per_pack INTO @stripes, @pills FROM product_info  WHERE id=_product_id;
        	IF _sales_unit="box" THEN
                SET @quantity=_qty*(@stripes*@pills);
            ELSEIF _sales_unit="stripe" THEN
                SET	@quantity=_qty*@pills;
            ELSE
                SET @quantity=_qty;
            END IF; 
	ELSEIF @category=4 THEN
    	SELECT num_inj_per_pack INTO @inj FROM product_info WHERE id=_product_id;
        IF _sales_unit="box" THEN
        	SET @quantity=_qty*@inj;
		ELSE
            SET @quantity=_qty;
        END IF; 
	ELSE
    	SET @quantity=_qty;
    END IF;
    IF NOT EXISTS(SELECT * FROM product_sales p WHERE (p.customer_id=_customer_id OR p.customer_name=_customer_name OR p.prescription_id=_prescription) AND p.invoice_no=_invoice AND date(p.date) <> date(now())) THEN
    	INSERT INTO product_sales(sales_type,customer_id,customer_name,prescription_id,invoice_no,product_id,sales_unit,qty,price,amount,user_id) VALUES(_type,_customer_id,_customer_name,_prescription,_invoice,_product_id,_sales_unit,_qty,_price,(_qty*_price),_user_id);
        UPDATE product_info SET qty=qty-@quantity WHERE id=_product_id;
        IF NOT EXISTS(SELECT * FROM sales_invoice_info si WHERE si.invoice =_invoice) THEN
        	INSERT INTO sales_invoice_info(invoice,total,discount,grand_total,paid,rest,user_id) VALUES(_invoice,_total,_discount,_grand_total,_paid,_rest,_user_id);
            IF _rest <> 0 THEN
            	UPDATE account_receivable SET amount=amount+_rest WHERE id=_customer_id;
            END IF;
        END IF;
    ELSE
    	SELECT "Exists" msg;
    END IF;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_reset_password` (IN `_password` VARCHAR(50), IN `_id` INT)  NO SQL
BEGIN
	UPDATE users SET pass=md5(_password) WHERE id=_id;
	SELECT "success|Reset password operation successfully completed" msg;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_review_symptoms` (IN `_name` VARCHAR(50), IN `_user_id` INT)  NO SQL
BEGIN
IF EXISTS(SELECT * FROM review_of_symptoms s WHERE s.name=_name) THEN
	SELECT concat('warning|',_name,' Already Exist') msg;
ELSE
	INSERT INTO review_of_symptoms(name,user_id) VALUES(_name,_user_id);
    SELECT concat('success|',_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_room` (IN `p_room_num` INT, IN `p_category` INT, IN `p_bed` INT, IN `p_dept` INT, IN `p_cost` FLOAT, IN `p_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
if EXISTS(SELECT id FROM room WHERE id = p_id) THEN
UPDATE room r set r.room_number=p_room_num,r.category=p_category,r.bed=p_bed,r.dept = p_dept,r.cost = p_cost WHERE r.id = p_id;
SELECT concat('success|',p_room_num,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT room_number FROM room WHERE room_number=p_room_num) THEN
SELECT concat('warning|',p_room_num,' Already Exist') msg;
ELSE
INSERT INTO room(room_number,category,bed,dept,cost,user_id) VALUES(p_room_num,p_category,p_bed,p_dept,p_cost,p_user_id);
SELECT concat('success|',p_room_num,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_room_category` (IN `p_room_category` VARCHAR(50), IN `p_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT r.id from room_category r WHERE r.id = p_id) THEN
UPDATE room_category r set r.name =p_room_category WHERE r.id = p_id;
SELECT concat('success|',p_room_category,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM room_category WHERE name=p_room_category) THEN
SELECT concat('warning|',p_room_category,' Already Exist') msg;
ELSE
INSERT INTO room_category(name,user_id) VALUES(p_room_category,p_user_id);
SELECT concat('success|',p_room_category,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_send_code` (IN `_user` VARCHAR(50))  NO SQL
BEGIN

if exists(SELECT email  FROM `users` WHERE username = _user OR tell = _user or email = _user) THEN

SELECT email into @tell FROM `users` WHERE username = _user OR tell = _user or email = _user;

SET @code = gen_code();

INSERT INTO user_code (email,`code`) VALUES (@tell,@code);

SELECT @tell email,@code `code`;

else

select 'The email, user, or phone Not Found';

end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_service` (IN `service_name` VARCHAR(50), IN `service_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT id FROM services WHERE id=p_id) THEN
UPDATE services s set s.name = service_name WHERE s.id = p_id;
SELECT concat('success|',service_name,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM services WHERE name=service_name) THEN
SELECT concat('warning|',service_name,' Already Exist') msg;
ELSE
INSERT INTO services(name,user_id) VALUES(service_name,service_user_id);
SELECT concat('success|',service_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_service_type` (IN `type_service` INT, IN `type_name` VARCHAR(50), IN `type_amount` FLOAT, IN `type_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT id FROM service_type WHERE id = p_id) THEN
UPDATE service_type s set s.service=type_service,s.name = type_name,s.amount=type_amount WHERE s.id = p_id;
SELECT concat('success|',type_name,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM service_type WHERE name=type_name) THEN
SELECT concat('warning|',type_name,' Already Exist') msg;
ELSE
INSERT INTO service_type(service,name,amount,user_id) VALUES(type_service,type_name,type_amount,type_user_id);
SELECT concat('success|',type_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_shift` (IN `shift_name` VARCHAR(50), IN `shift_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT id from shift WHERE id = p_id) THEN
UPDATE shift s set s.name =shift_name WHERE s.id = p_id;
SELECT concat('success|',shift_name,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM shift WHERE name=shift_name) THEN
SELECT concat('warning|',shift_name,' Already Exist') msg;
ELSE
INSERT INTO shift(name,user_id) VALUES(shift_name,shift_user_id);
SELECT concat('success|',shift_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_specialist` (IN `p_id` INT, IN `specialist_name` VARCHAR(50), IN `user_id` INT)  NO SQL
BEGIN 
if EXISTS(SELECT s.id FROM specialist s WHERE s.id = p_id) THEN
UPDATE specialist s set s.name = specialist_name WHERE s.id = p_id;
SELECT concat('success|',specialist_name,' Specialist Sucessfuly Updated') msg;
ELSEIF EXISTS(SELECT name FROM specialist WHERE name=specialist_name) THEN
SELECT concat('warning|',specialist_name,' Already Exist') msg;
ELSE
INSERT INTO specialist(name,user_id) VALUES(specialist_name,user_id);
SELECT concat('success|',specialist_name,' Specialist Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_stuff` (IN `stuff_full_name` VARCHAR(100), IN `stuff_email` VARCHAR(50), IN `stuff_address` VARCHAR(50), IN `stuff_tell` VARCHAR(50), IN `stuff_department` INT, IN `stuff_designation` INT, IN `stuff_shift` INT, IN `stuff_office_tell` VARCHAR(50), IN `stuff_gender` VARCHAR(50), IN `stuff_blood_group` INT, IN `stuff_biography` VARCHAR(200), IN `stuff_Image` VARCHAR(200), IN `stuff_user_id` INT)  NO SQL
BEGIN
IF EXISTS(SELECT * FROM stuff s WHERE s.full_name=stuff_full_name AND s.email=stuff_email) THEN
	SELECT concat('warning|',stuff_full_name,' Already Registered') msg;
ELSE
    INSERT INTO stuff(full_Name,email,address,tell,department,designation,shift,office_tell,gender,blood_group,biography,Image,user_id) VALUES(stuff_full_name,stuff_email,stuff_address,stuff_tell,stuff_department,stuff_designation,stuff_shift,stuff_office_tell,stuff_gender,stuff_blood_group,stuff_biography,stuff_Image,stuff_user_id);
    SELECT concat('success|',stuff_full_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_supplier` (IN `P_name` VARCHAR(50), IN `P_tell` VARCHAR(50), IN `P_email` VARCHAR(50), IN `P_address` VARCHAR(50), IN `P_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN
IF EXISTS(SELECT id FROM supplier WHERE id = p_id) THEN
UPDATE supplier s set s.name = p_name,s.tell=P_tell,s.email=P_email,s.address=P_address WHERE s.id = p_id;
SELECT "success|Suplier successfully Updated" msg;

ELSEIF EXISTS(SELECT * FROM supplier s WHERE s.name=p_name OR s.tell=P_tell OR s.email=P_email) THEN
	SELECT "warning| Supplier alread registered" msg;
ELSE
	INSERT INTO supplier(name,tell,email,address,user_id) VALUES(p_name,P_tell,P_email,P_address,P_user_id);
    SELECT "success|Suplier successfully registered" msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_test` (IN `test_lab` INT, IN `test_name` VARCHAR(50), IN `test_amount` FLOAT, IN `test_user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT id from test WHERE id = p_id) THEN
UPDATE test t set t.lab = test_lab,t.name = test_name,t.amount=test_amount WHERE t.id = p_id;
SELECT concat('success|',test_name,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM test WHERE name=test_name) THEN
SELECT concat('warning|',test_name,' Already Exist') msg;
ELSE
INSERT INTO test(lab,name,amount,user_id) VALUES(test_lab,test_name,test_amount,test_user_id);
SELECT concat('success|',test_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ticket` (IN `p_id` INT, IN `doctor_id` INT, IN `ticket_cost` FLOAT, IN `user_id` INT)  NO SQL
BEGIN 
START TRANSACTION;
IF EXISTS(SELECT * FROM ticket t WHERE t.patient_id=p_id AND t.doctor=doctor_id AND date(t.date)=date(now())) THEN
	SELECT concat('warning|This patient already has ',t.ticket_no," ticket No") msg FROM ticket t WHERE t.patient_id=p_id AND t.doctor=doctor_id AND date(t.date)=date(now());
ELSE
	SELECT CASE WHEN ticket_no is null THEN  1 ELSE max(ticket_no)+1 END into @ticket FROM ticket WHERE doctor = doctor_id and DATE(date) = DATE(NOW());
	INSERT INTO ticket(ticket_no,patient_id,doctor,cost,p_status,user_id) VALUES(@ticket,p_id,doctor_id,ticket_cost,1,user_id);  
	SELECT concat('success|Ticket Number  ', @ticket,' Sucessfuly Registered') msg;
END IF;	
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_unit_measure` (IN `unit_measure_name` VARCHAR(50), IN `des` VARCHAR(200), IN `user_id` INT, IN `p_id` INT)  NO SQL
BEGIN 
IF EXISTS(SELECT id from unit_measure WHERE id = p_id) THEN
UPDATE unit_measure u set u.name = unit_measure_name,u.description = des WHERE u.id = p_id;
SELECT concat('success|',unit_measure_name,' Sucessfuly Updated') msg;

ELSEIF EXISTS(SELECT name FROM unit_measure WHERE name=unit_measure_name) THEN
SELECT concat('warning|',unit_measure_name,' Already Exist') msg;
ELSE
INSERT INTO unit_measure(name,description,user_id) VALUES(unit_measure_name,des,user_id);
SELECT concat('success|',unit_measure_name,' Sucessfuly Registered') msg;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update` (IN `t` VARCHAR(50), IN `row_id` INT)  NO SQL
BEGIN

if( t = 'users') THEN

SELECT username as `User Name`,image `Choose Image|file|image`,email `Email Address|email|email`,tell `Phone Number|text|phone` from users where id= row_id;

ELSEIF( t = 'specialist') THEN

SELECT name as `Specialist Name` from specialist where id= row_id;

ELSEIF( t = 'department') THEN

SELECT name as `Department Name` from department where id= row_id;

ELSEIF( t = 'doctor') THEN

SELECT name `Full Name`,username as `User Name`,email `Email Address|email|email`,address `Address`,tell `Phone Number|text|phone`, department `Department|dropdown|department`, specialist `Specialist|dropdown|specialist`, office_tell `Office Tell`,blood_group`Blood group|dropdown|blood_group`,image `Choose Image|file|image` from doctor where id= row_id;

ELSEIF( t = 'room_category') THEN

SELECT name as `Room Category` from room_category where id= row_id;

ELSEIF( t = 'room') THEN

SELECT r.room_number as `Room Number`,r.category `Room Category|dropdown|room_category`, r.bed `Bed Number|number|Bed`, r.dept `Department|dropdown|department`, r.cost as `Room Cost` from room r where id= row_id;

ELSEIF( t = 'drug_category') THEN

SELECT name as `Drug Category` from drug_category where id= row_id;

ELSEIF( t = 'unit_measure') THEN

SELECT name as `Unit Measure`, description `Unit Measur|textarea|` from unit_measure where id= row_id;

ELSEIF( t = 'drug') THEN

SELECT * from drug where id= row_id;

ELSEIF( t = 'designation') THEN

SELECT name as `Designation` from designation where id= row_id;

ELSEIF( t = 'shift') THEN

SELECT name as `Shift` from shift where id= row_id;

ELSEIF( t = 'stuff') THEN

SELECT full_name `Full Name`,email `Email Address|email|email`,address `Address`,tell `Phone Number|text|phone`, department `Department|dropdown|department`, designation `Specialist|dropdown|designation`, shift `Shift`, office_tell `Office Tell`,blood_group`Blood group|dropdown|blood_group`,image `Choose Image|file|image` from stuff where id= row_id;

ELSEIF( t = 'patient') THEN
SELECT p.name `Full Name`,p.tell `Tell`, p.address `Address`, p.gender `Gender |dropdown|gender`, p.age `Age`, p.weight `Weight`,p.marital_status `Marital Status |dropdown|marital_status`  from ticket t JOIN patient p on t.patient_id = p.id JOIN doctor d on d.id = t.doctor JOIN gender g on g.id= d.gender JOIN marital_status m on m.id = p.marital_status where p.id= row_id;

ELSEIF( t = 'lab') THEN

SELECT name as `Lab Name` from lab where id= row_id;

ELSEIF( t = 'test') THEN

SELECT lab `Lab |dropdown|lab`, name as `Test Name` from test where id= row_id;

end if;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_form` (IN `p_table` VARCHAR(50), IN `p_id` INT)  NO SQL
BEGIN
IF p_table="lab" THEN
	SELECT l.id "id",l.name "lab_name" FROM lab l WHERE l.id=p_id;
ELSEIF p_table="image" THEN
	SELECT i.id "id",i.name "image_name" FROM image i WHERE i.id=p_id;
ELSEIF p_table="clinicaldata" THEN
	SELECT c.id "id",c.image "image_name",c.name "clinicalData_name",c.amount "amount" FROM clinicaldata c JOIN image i on c.image = c.id WHERE c.id = p_id;
ELSEIF p_table="services" THEN
	SELECT s.id "id",s.name "Service_name" FROM services s WHERE s.id=p_id;
ELSEIF p_table="service_type" THEN
	select st.id "id",st.service as "service_name",st.name "service_type",st.amount "amount" FROM service_type st join services s on s.id = st.service where st.id = p_id;
ELSEIF p_table="test" THEN
	SELECT t.id "id",t.lab "lab_name",t.name "lab_test_name",t.amount "amount" FROM test t JOIN lab l on t.lab = l.id WHERE t.id = p_id;
ELSEIF p_table ="specialist" THEN
	select s.id "id",s.name "specialist_Name" from specialist s where s.id = p_id;
ELSEIF p_table ="department" THEN
	select d.id "id", d.name "dept_name" from department d where d.id = p_id;
ELSEIF p_table ="diagnosis" THEN
	select d.id "id",d.name "diagnose_name" from diagnosis d where d.id = p_id;
ELSEIF p_table ="room_category" THEN
	SELECT rc.id "id",rc.name "name" from room_category rc where rc.id = p_id;
ELSEIF p_table ="room" THEN
	SELECT r.id "id",r.room_number "room_number",r.category "room_category",r.bed "Beds",r.dept "department",r.cost "room_cost" FROM room r  where r.id = p_id;
ELSEIF p_table ="designation" THEN
	SELECT d.id "id",d.name "designation" from designation d where d.id = p_id;
ELSEIF p_table ="shift" THEN
	SELECT s.id "id",s.name "shift" FROM shift s WHERE s.id =p_id;
ELSEIF p_table ="unit_measure" THEN
	SELECT u.id "id", u.name "unit_measure",u.description "unit_desc" from unit_measure u WHERE u.id = p_id;
ELSEIF p_table="drug_category" THEN
	SELECT d.id "id",d.name "category_name" FROM drug_category d WHERE d.id = p_id;
ELSEIF p_table = "supplier" THEN
	SELECT s.id "id",s.name "supplier_name",s.tell "supplier_tell",s.email "supplier_email",s.address "supplier_address" FROM supplier s WHERE s.id = p_id;
ELSEIF p_table ="product_info" THEN
	SELECT p.brand_name "brnad_name",p.generic_name "generic_name",p.category "drug_category",p.country "country",p.preferred_supplier "preffered_supplier",p.purchase_cost "purchase_price",p.sell_price "sell_price",p.mfg_date "mfg_date",p.exp_date "exp_date" FROM product_info p WHERE p.id = p_id;
ELSEIF p_table="doctor" THEN
	SELECT d.id "id", d.name "doctor_name",d.tell "doctor_tell",d.email "doctor_email", d.address "doctor_address",d.department "doctor_dep",d.specialist "doctor_specialist",d.biography "doctor_biography",d.office_tell "office_tel",d.gender "gender",d.blood_group "blood_group",d.ticket_cost "ticket" FROM doctor d WHERE d.id=p_id;
ELSEIF p_table="marketer" THEN
	SELECT m.name "marketer_name",m.tel "marketer_tell",m.email "marketer_email",m.address "marketer_address",m.id "id" FROM marketer m WHERE m.id=p_id;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user` (IN `_name` VARCHAR(50), IN `_phone` VARCHAR(20), IN `_email` VARCHAR(50), IN `_img` TEXT, IN `_username` VARCHAR(50), IN `_password` VARCHAR(50), IN `_user_id` INT)  NO SQL
BEGIN
START TRANSACTION;
IF EXISTS(SELECT * from admin a WHERE a.email=_email) THEN
	SELECT "warning|This user has already registered" msg;
ELSE
    IF EXISTS(SELECT * from users WHERE username=_username) THEN
        SELECT "warning|This username is already taken please choose another username" msg;
    ELSE
    	INSERT INTO admin(name,phone,email,user_id) VALUES(_name,_phone,_email,_user_id);
        SELECT MAX(id) into @id FROM admin;
        UPDATE users set username=_username,pass=md5(_password),Image=_img WHERE user_id=@id AND usertype=1;
        SELECT "success|User successfully registered" msg;
    END IF;
END IF;
COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_vital_signs` (IN `_name` VARCHAR(50), IN `_user_id` INT)  NO SQL
BEGIN
IF EXISTS(SELECT * FROM vital_signs v WHERE v.name=_name) THEN
	SELECT concat('warning|',_name,' Already Exist') msg;
ELSE
	INSERT INTO vital_signs(name,user_id) VALUES(_name,_user_id);
    SELECT concat('warning|',_name,' Sucessfuly Registered') msg;
END IF;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `gen_code` () RETURNS INT(11) NO SQL
BEGIN

SET @code = 1001;

SELECT `code`+id into @code FROM `user_code` order by `code` desc  limit 1;


return @code;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account_payable`
--

CREATE TABLE `account_payable` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_payable`
--

INSERT INTO `account_payable` (`id`, `supplier_id`, `amount`) VALUES
(1, 1, 32000),
(2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `account_receivable`
--

CREATE TABLE `account_receivable` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_receivable`
--

INSERT INTO `account_receivable` (`id`, `customer_id`, `amount`) VALUES
(1, 1, 5009.5);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `phone`, `email`, `date`, `user_id`) VALUES
(1, 'Abdisalan Abdullahi ', '0618796358', 'aamadan2@gmail.com', '2021-01-18 07:08:33', 1),
(2, 'Baaba', '61544778855', 'adasgaf', '2021-01-18 07:20:54', 12),
(3, 'Yuushac Khan', '061578963578', 'yuushac@gmail.com', '2021-01-18 07:25:14', 2),
(4, 'Saed Mohamud', '618454556', 'saciidkoronto2018@gmail.com', '2021-02-01 06:22:36', 0),
(5, 'Dr. Sayid Omar Mohamed', '616666637', 'sayid@jazeerauniversity.edu.so', '2021-02-08 11:01:09', 4);

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `add_user` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
	INSERT INTO users(user_id,usertype,registered_user_id) VALUES(new.id,1,new.user_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `name`) VALUES
(1, 'A-'),
(2, 'A+'),
(3, 'AB-'),
(4, 'AB+'),
(5, 'B-'),
(6, 'B+'),
(7, 'O-'),
(8, 'O+');

-- --------------------------------------------------------

--
-- Table structure for table `cash_sales`
--

CREATE TABLE `cash_sales` (
  `id` int(11) NOT NULL,
  `sales_type` varchar(50) NOT NULL DEFAULT 'Cash Sales',
  `customer_name` varchar(50) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sales_unit` varchar(50) NOT NULL,
  `qty` float NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cash_sales`
--

INSERT INTO `cash_sales` (`id`, `sales_type`, `customer_name`, `invoice_no`, `product_id`, `sales_unit`, `qty`, `price`, `amount`, `date`, `user_id`) VALUES
(1, 'Cash Sales', 'Cash Sales', 41, 1, 'item', 10, 0.05, 0.5, '2021-04-26 13:31:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clinicaldata`
--

CREATE TABLE `clinicaldata` (
  `id` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clinicaldata`
--

INSERT INTO `clinicaldata` (`id`, `image`, `name`, `amount`, `user_id`, `date`) VALUES
(1, 1, 'A', 2, 4, '2021-02-01 06:55:11'),
(2, 2, 'B', 2, 4, '2021-02-01 06:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `tel1` varchar(15) NOT NULL,
  `tel2` varchar(15) NOT NULL,
  `tel3` varchar(15) NOT NULL,
  `fg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`id`, `name`, `address`, `tel1`, `tel2`, `tel3`, `fg`) VALUES
(1, 'Jazeera University', 'Wadajir, Bulahubey', '0618796358', '0617535912', '0613511341', 'Soo laabashadu waa 10 Maalmood');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Aruba'),
(2, 'Afghanistan'),
(3, 'Angola'),
(4, 'Anguilla'),
(5, 'Albania'),
(6, 'Andorra'),
(7, 'Netherlands Antilles'),
(8, 'United Arab Emirates'),
(9, 'Argentina'),
(10, 'Armenia'),
(11, 'American Samoa'),
(12, 'Antarctica'),
(13, 'French Southern territories'),
(14, 'Antigua and Barbuda'),
(15, 'Australia'),
(16, 'Austria'),
(17, 'Azerbaijan'),
(18, 'Burundi'),
(19, 'Belgium'),
(20, 'Benin'),
(21, 'Burkina Faso'),
(22, 'Bangladesh'),
(23, 'Bulgaria'),
(24, 'Bahrain'),
(25, 'Bahamas'),
(26, 'Bosnia and Herzegovina'),
(27, 'Belarus'),
(28, 'Belize'),
(29, 'Bermuda'),
(30, 'Bolivia'),
(31, 'Brazil'),
(32, 'Barbados'),
(33, 'Brunei'),
(34, 'Bhutan'),
(35, 'Bouvet Island'),
(36, 'Botswana'),
(37, 'Central African Republic'),
(38, 'Canada'),
(39, 'Cocos (Keeling) Islands'),
(40, 'Switzerland'),
(41, 'Chile'),
(42, 'China'),
(43, 'Côte d’Ivoire'),
(44, 'Cameroon'),
(45, 'Congo, The Democratic Republic of the'),
(46, 'Congo'),
(47, 'Cook Islands'),
(48, 'Colombia'),
(49, 'Comoros'),
(50, 'Cape Verde'),
(51, 'Costa Rica'),
(52, 'Cuba'),
(53, 'Christmas Island'),
(54, 'Cayman Islands'),
(55, 'Cyprus'),
(56, 'Czech Republic'),
(57, 'Germany'),
(58, 'Djibouti'),
(59, 'Dominica'),
(60, 'Denmark'),
(61, 'Dominican Republic'),
(62, 'Algeria'),
(63, 'Ecuador'),
(64, 'Egypt'),
(65, 'Eritrea'),
(66, 'Western Sahara'),
(67, 'Spain'),
(68, 'Estonia'),
(69, 'Ethiopia'),
(70, 'Finland'),
(71, 'Fiji Islands'),
(72, 'Falkland Islands'),
(73, 'France'),
(74, 'Faroe Islands'),
(75, 'Micronesia, Federated States of'),
(76, 'Gabon'),
(77, 'United Kingdom'),
(78, 'Georgia'),
(79, 'Ghana'),
(80, 'Gibraltar'),
(81, 'Guinea'),
(82, 'Guadeloupe'),
(83, 'Gambia'),
(84, 'Guinea-Bissau'),
(85, 'Equatorial Guinea'),
(86, 'Greece'),
(87, 'Grenada'),
(88, 'Greenland'),
(89, 'Guatemala'),
(90, 'French Guiana'),
(91, 'Guam'),
(92, 'Guyana'),
(93, 'Hong Kong'),
(94, 'Heard Island and McDonald Islands'),
(95, 'Honduras'),
(96, 'Croatia'),
(97, 'Haiti'),
(98, 'Hungary'),
(99, 'Indonesia'),
(100, 'India'),
(101, 'British Indian Ocean Territory'),
(102, 'Ireland'),
(103, 'Iran'),
(104, 'Iraq'),
(105, 'Iceland'),
(106, 'Israel'),
(107, 'Italy'),
(108, 'Jamaica'),
(109, 'Jordan'),
(110, 'Japan'),
(111, 'Kazakstan'),
(112, 'Kenya'),
(113, 'Kyrgyzstan'),
(114, 'Cambodia'),
(115, 'Kiribati'),
(116, 'Saint Kitts and Nevis'),
(117, 'South Korea'),
(118, 'Kuwait'),
(119, 'Laos'),
(120, 'Lebanon'),
(121, 'Liberia'),
(122, 'Libyan Arab Jamahiriya'),
(123, 'Saint Lucia'),
(124, 'Liechtenstein'),
(125, 'Sri Lanka'),
(126, 'Lesotho'),
(127, 'Lithuania'),
(128, 'Luxembourg'),
(129, 'Latvia'),
(130, 'Macao'),
(131, 'Morocco'),
(132, 'Monaco'),
(133, 'Moldova'),
(134, 'Madagascar'),
(135, 'Maldives'),
(136, 'Mexico'),
(137, 'Marshall Islands'),
(138, 'Macedonia'),
(139, 'Mali'),
(140, 'Malta'),
(141, 'Myanmar'),
(142, 'Mongolia'),
(143, 'Northern Mariana Islands'),
(144, 'Mozambique'),
(145, 'Mauritania'),
(146, 'Montserrat'),
(147, 'Martinique'),
(148, 'Mauritius'),
(149, 'Malawi'),
(150, 'Malaysia'),
(151, 'Mayotte'),
(152, 'Namibia'),
(153, 'New Caledonia'),
(154, 'Niger'),
(155, 'Norfolk Island'),
(156, 'Nigeria'),
(157, 'Nicaragua'),
(158, 'Niue'),
(159, 'Netherlands'),
(160, 'Norway'),
(161, 'Nepal'),
(162, 'Nauru'),
(163, 'New Zealand'),
(164, 'Oman'),
(165, 'Pakistan'),
(166, 'Panama'),
(167, 'Pitcairn'),
(168, 'Peru'),
(169, 'Philippines'),
(170, 'Palau'),
(171, 'Papua New Guinea'),
(172, 'Poland'),
(173, 'Puerto Rico'),
(174, 'North Korea'),
(175, 'Portugal'),
(176, 'Paraguay'),
(177, 'Palestine'),
(178, 'French Polynesia'),
(179, 'Qatar'),
(180, 'Réunion'),
(181, 'Romania'),
(182, 'Russian Federation'),
(183, 'Rwanda'),
(184, 'Saudi Arabia'),
(185, 'Sudan'),
(186, 'Senegal'),
(187, 'Singapore'),
(188, 'South Georgia and the South Sandwich Islands'),
(189, 'Saint Helena'),
(190, 'Svalbard and Jan Mayen'),
(191, 'Solomon Islands'),
(192, 'Sierra Leone'),
(193, 'El Salvador'),
(194, 'San Marino'),
(195, 'Somalia'),
(196, 'Saint Pierre and Miquelon'),
(197, 'Sao Tome and Principe'),
(198, 'Suriname'),
(199, 'Slovakia'),
(200, 'Slovenia'),
(201, 'Sweden'),
(202, 'Swaziland'),
(203, 'Seychelles'),
(204, 'Syria'),
(205, 'Turks and Caicos Islands'),
(206, 'Chad'),
(207, 'Togo'),
(208, 'Thailand'),
(209, 'Tajikistan'),
(210, 'Tokelau'),
(211, 'Turkmenistan'),
(212, 'East Timor'),
(213, 'Tonga'),
(214, 'Trinidad and Tobago'),
(215, 'Tunisia'),
(216, 'Turkey'),
(217, 'Tuvalu'),
(218, 'Taiwan'),
(219, 'Tanzania'),
(220, 'Uganda'),
(221, 'Ukraine'),
(222, 'United States Minor Outlying Islands'),
(223, 'Uruguay'),
(224, 'United States'),
(225, 'Uzbekistan'),
(226, 'Holy See (Vatican City State)'),
(227, 'Saint Vincent and the Grenadines'),
(228, 'Venezuela'),
(229, 'Virgin Islands, British'),
(230, 'Virgin Islands, U.S.'),
(231, 'Vietnam'),
(232, 'Vanuatu'),
(233, 'Wallis and Futuna'),
(234, 'Samoa'),
(235, 'Yemen'),
(236, 'Yugoslavia'),
(237, 'South Africa'),
(238, 'Zambia'),
(239, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `landline_number` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `marketer` int(11) NOT NULL,
  `max_balance` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `type`, `name`, `email`, `mobile_number`, `landline_number`, `address`, `marketer`, `max_balance`, `date`, `user_id`) VALUES
(1, 'company', 'Ex-Hilac Pharmacy', 'hilaac@gmail.com', '0615567171', '653492', 'Bakaaro Suuqa Daawada', 1, 3000, '2021-02-10 12:26:48', 1);

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `insert_account_recievable` AFTER INSERT ON `customer` FOR EACH ROW BEGIN
INSERT INTO account_receivable(customer_id,amount) VALUES(new.id,0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_sales`
--

CREATE TABLE `customer_sales` (
  `id` int(11) NOT NULL,
  `sales_type` varchar(50) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sales_unit` varchar(50) NOT NULL,
  `qty` float NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_sales`
--

INSERT INTO `customer_sales` (`id`, `sales_type`, `customer_id`, `invoice_no`, `product_id`, `sales_unit`, `qty`, `price`, `amount`, `date`, `user_id`) VALUES
(1, 'Customer Sales', '1', 42, 1, 'stripe', 9, 0.5, 4.5, '2021-04-28 08:57:20', 1),
(2, 'Customer Sales', '1', 43, 1, 'stripe', 10, 0.5, 5, '2021-04-28 08:58:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `user_id`, `date`) VALUES
(1, 'Orthopedic', 1, '2021-02-08 10:47:39'),
(2, 'B', 2, '2020-12-09 05:55:50'),
(3, 'C', 2, '2020-12-12 07:39:11'),
(4, 'D', 2, '2020-12-12 07:40:31'),
(11, 'depts', 2, '2020-12-22 08:21:32'),
(12, 'TEST', 2, '2020-12-26 11:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `name`, `user_id`, `date`) VALUES
(1, 'Nurse', 2, '2021-01-19 07:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `name`, `date`, `user_id`) VALUES
(1, 'Hepatitis B', '2021-01-25 10:38:52', 1),
(2, 'Maleria ', '2021-01-30 08:00:26', 1),
(3, 'Typhoid', '2021-02-04 06:12:50', 4),
(4, ' Hepatitis A', '2021-02-04 06:23:19', 4);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `tell` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `specialist` varchar(50) NOT NULL,
  `office_tell` varchar(50) NOT NULL,
  `gender` int(11) NOT NULL,
  `blood_group` varchar(50) NOT NULL,
  `biography` varchar(200) NOT NULL,
  `ticket_cost` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `email`, `address`, `tell`, `department`, `specialist`, `office_tell`, `gender`, `blood_group`, `biography`, `ticket_cost`, `user_id`, `date`) VALUES
(1, 'Abdisalan Abdullahi Mohamed', 'aamadan2@gmail.com', 'Wadajir Bula Hubey', '0618796358', '1', '1', '657896', 1, '2', 'Medic', 10, 1, '2021-01-19 08:04:03'),
(2, 'Isse Asad Libax', 'isse@gmail.com', 'Wadajir Bula Hubey', '0616454578', '1', '1', '654512', 1, '2', 'Internal medicine', 15, 0, '2021-01-21 07:53:22'),
(3, 'Dr. Sayid Omar Mohamed', 'sayid@jazeerauniversity.edu.so', 'Hodan', '616666637', '1', '7', '616666637', 1, '2', 'Orthopedic Specialist', 15, 4, '2021-02-08 10:54:29');

--
-- Triggers `doctor`
--
DELIMITER $$
CREATE TRIGGER `add_doctor_user` AFTER INSERT ON `doctor` FOR EACH ROW BEGIN
	INSERT INTO users(user_id,usertype,registered_user_id) VALUES(new.id,2,new.user_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

CREATE TABLE `drug` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `generic_name` varchar(50) NOT NULL,
  `category` int(11) NOT NULL,
  `unit_measure` int(11) NOT NULL,
  `unit_value` varchar(50) NOT NULL,
  `num_of_pack` int(11) NOT NULL,
  `qty_per_pack` int(11) NOT NULL,
  `qty_on_hand` int(11) NOT NULL,
  `re_oder_qty` int(11) NOT NULL,
  `cost` float NOT NULL,
  `price` float NOT NULL,
  `mfg_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drug`
--

INSERT INTO `drug` (`id`, `brand_name`, `generic_name`, `category`, `unit_measure`, `unit_value`, `num_of_pack`, `qty_per_pack`, `qty_on_hand`, `re_oder_qty`, `cost`, `price`, `mfg_date`, `exp_date`, `user_id`, `date`) VALUES
(1, 'Amocklavin ', 'Amox+clox', 2, 2, '1', 10, 10, 100, 1, 1.1, 1.3, '2018-12-19', '2022-01-19', 2, '2020-12-19 10:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `drug_category`
--

CREATE TABLE `drug_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drug_category`
--

INSERT INTO `drug_category` (`id`, `name`, `user_id`, `date`) VALUES
(1, 'Tablet', 1, '2021-01-25 11:38:07'),
(2, 'Capsule', 1, '2021-01-25 11:38:13'),
(3, 'Syrup', 1, '2021-01-25 11:38:17'),
(4, 'Injection', 2, '2021-01-25 11:38:23'),
(5, 'Supposto', 1, '2021-01-25 11:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `history_taking`
--

CREATE TABLE `history_taking` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `cheif_complaint` text NOT NULL,
  `history_present_illness` text NOT NULL,
  `past_medical_history` text NOT NULL,
  `drug_history` text NOT NULL,
  `allergies` text NOT NULL,
  `family_hsitory` text DEFAULT NULL,
  `social_history` text NOT NULL,
  `obs_gyne_history` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_taking`
--

INSERT INTO `history_taking` (`id`, `patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `cheif_complaint`, `history_present_illness`, `past_medical_history`, `drug_history`, `allergies`, `family_hsitory`, `social_history`, `obs_gyne_history`, `date`, `user_id`) VALUES
(1, 2, 1, '2021-01-21', 2, '', '', '', '', '', '', '', '', '2021-02-02 07:53:31', 3);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `name`, `user_id`, `date`) VALUES
(1, 'x-ray', 4, '2021-02-01 06:39:53'),
(2, 'ECG', 4, '2021-02-01 06:41:57'),
(3, 'Ultrasound ', 4, '2021-02-04 07:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `image_request`
--

CREATE TABLE `image_request` (
  `id` int(11) NOT NULL,
  `image_tran_no` bigint(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `image_test_id` int(11) NOT NULL,
  `image_status` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_request`
--

INSERT INTO `image_request` (`id`, `image_tran_no`, `patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `image_test_id`, `image_status`, `date`, `user_id`) VALUES
(1, 5, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-02 11:32:02', 3),
(2, 5, 5, 1, '2021-02-01', 2, 2, 'Ordered', '2021-02-02 11:32:02', 3),
(3, 6, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-03 10:39:48', 3),
(4, 6, 5, 1, '2021-02-01', 2, 2, 'Ordered', '2021-02-03 10:39:48', 3),
(5, 7, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-03 10:40:15', 3),
(6, 7, 5, 1, '2021-02-01', 2, 2, 'Ordered', '2021-02-03 10:40:15', 3),
(7, 8, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-06 10:32:42', 3),
(8, 8, 5, 1, '2021-02-01', 2, 2, 'Ordered', '2021-02-06 10:32:42', 3),
(9, 9, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-09 11:02:44', 3),
(10, 9, 5, 1, '2021-02-01', 2, 2, 'Ordered', '2021-02-09 11:02:44', 3);

--
-- Triggers `image_request`
--
DELIMITER $$
CREATE TRIGGER `image_charge` AFTER INSERT ON `image_request` FOR EACH ROW BEGIN
SELECT amount INTO @amount FROM clinicaldata WHERE id = new.image_test_id;
INSERT INTO patient_charge  (`patient_id`,`type`, `investigation_id`, `amount`) VALUES (new.patient_id,'image',new.image_test_id,@amount);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id`, `name`, `user_id`, `date`) VALUES
(3, 'Hematology ', 1, '2020-03-14 08:05:57'),
(6, 'Microbiology and Parasitology ', 1, '2020-03-14 08:05:57'),
(7, 'Serology ', 1, '2020-03-14 08:05:57'),
(8, 'Stool', 1, '2020-03-14 08:05:57'),
(10, 'Biochemistry', 1, '2020-03-15 09:58:38'),
(11, 'Hormones', 1, '2020-03-15 09:58:59'),
(12, 'Coagulation Profile', 1, '2020-03-15 10:39:26'),
(13, 'TB Analysis', 1, '2020-03-15 10:39:55'),
(14, 'Histology and Cytology', 1, '2020-03-15 10:40:10'),
(15, 'Arterial Blood Gas', 1, '2020-03-15 10:40:33'),
(23, 'Test Lab this is lab', 2, '2020-12-28 06:25:37'),
(24, 'test lab', 2, '2021-01-16 11:10:48'),
(25, 'Hematologies', 2, '2021-01-17 05:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `lab_request`
--

CREATE TABLE `lab_request` (
  `id` int(11) NOT NULL,
  `lab_tran_no` bigint(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `lab_test_id` int(11) NOT NULL,
  `lab_status` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lab_request`
--

INSERT INTO `lab_request` (`id`, `lab_tran_no`, `patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `lab_test_id`, `lab_status`, `date`, `user_id`) VALUES
(1, 12, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-07 05:26:33', 3),
(2, 13, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-07 05:30:48', 3),
(3, 14, 2, 1, '2021-01-21', 2, 1, 'Ordered', '2021-02-07 05:39:35', 3),
(4, 14, 2, 1, '2021-01-21', 2, 2, 'Ordered', '2021-01-21 05:39:35', 3),
(5, 15, 2, 1, '2021-01-21', 2, 1, 'Ordered', '2021-01-21 10:54:04', 3),
(6, 16, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-07 11:56:18', 3),
(7, 16, 5, 1, '2021-02-01', 2, 2, 'Ordered', '2021-02-07 11:56:18', 3),
(8, 17, 6, 1, '2021-02-08', 3, 1, 'Ordered', '2021-02-08 11:58:40', 5),
(9, 17, 6, 1, '2021-02-08', 3, 2, 'Ordered', '2021-02-08 11:58:40', 5),
(10, 17, 6, 1, '2021-02-08', 3, 3, 'Ordered', '2021-02-08 11:58:40', 5),
(11, 18, 6, 1, '2021-02-08', 3, 1, 'Ordered', '2021-02-08 12:07:05', 5),
(12, 18, 6, 1, '2021-02-08', 3, 2, 'Ordered', '2021-02-08 12:07:05', 5),
(13, 18, 6, 1, '2021-02-08', 3, 3, 'Ordered', '2021-02-08 12:07:05', 5),
(14, 19, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-09 11:02:38', 3),
(15, 19, 5, 1, '2021-02-01', 2, 2, 'Ordered', '2021-02-09 11:02:38', 3),
(16, 19, 5, 1, '2021-02-01', 2, 3, 'Ordered', '2021-02-09 11:02:38', 3);

--
-- Triggers `lab_request`
--
DELIMITER $$
CREATE TRIGGER `lab_charge` AFTER INSERT ON `lab_request` FOR EACH ROW BEGIN
SELECT amount INTO @amount FROM test WHERE id = new.lab_test_id;
INSERT INTO patient_charge  (`patient_id`,`type`,`tran_no`, `investigation_id`, `amount`) VALUES (new.patient_id,'lab',New.lab_tran_no,new.lab_test_id,@amount);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `lab_status`
--

CREATE TABLE `lab_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

CREATE TABLE `marital_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`id`, `name`) VALUES
(1, 'Single'),
(2, 'Married');

-- --------------------------------------------------------

--
-- Table structure for table `marketer`
--

CREATE TABLE `marketer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marketer`
--

INSERT INTO `marketer` (`id`, `name`, `tel`, `email`, `address`, `date`, `user_id`) VALUES
(1, 'Abdisalan Abdullahi Mohamed', '0618796355', 'aamadan2@gmail.com', 'wadajir Bula Hubey', '2021-02-07 11:30:30', 1),
(2, 'Ali', '12345', 'aam', 'wadajir', '2021-02-21 13:02:46', 1),
(3, 'test', '123', 'aamadan24@gmail.com', 'wadajir Ceelqalows', '2021-02-21 13:03:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `msg` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tell` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `tell`, `address`, `gender`, `age`, `marital_status`, `user_id`, `date`) VALUES
(1, 'Sayid Ali Aded Mohamed', '0615353625', 'Yaqshid Towfiq', '1', 23, '1', 1, '2021-01-21 10:24:27'),
(2, 'Sacid Maxamud Sh Muse', '0618454556', 'Hodan KPP', '1', 25, '1', 1, '2021-01-21 10:24:30'),
(3, 'Yahye Omar Wehliye', '0618354678', 'Wadajir Aus', '1', 10, '1', 1, '2021-01-21 10:26:29'),
(4, 'Abdifitah Abdullahi', '0618121221', 'wadajir', '1', 40, '1', 1, '2021-01-27 11:36:28'),
(5, 'Ali Mohamed Ahmed', '618232412', 'Hodan', '1', 33, '2', 4, '2021-02-01 07:03:12'),
(6, 'Sameer Ahmed culusow', '616584999', 'Towfiq', '1', 7, '1', 6, '2021-02-08 11:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `patient_charge`
--

CREATE TABLE `patient_charge` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `tran_no` int(11) NOT NULL,
  `investigation_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_charge`
--

INSERT INTO `patient_charge` (`id`, `patient_id`, `type`, `tran_no`, `investigation_id`, `amount`, `status`, `user_id`, `date`) VALUES
(1, 5, 'lab', 19, 1, 1, '', 0, '2021-02-09 11:02:38'),
(2, 5, 'lab', 19, 2, 1, '', 0, '2021-02-09 11:02:38'),
(3, 5, 'lab', 19, 3, 1, '', 0, '2021-02-09 11:02:38'),
(4, 5, 'image', 0, 1, 2, '', 0, '2021-02-09 11:02:44'),
(5, 5, 'image', 0, 2, 2, '', 0, '2021-02-09 11:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `patient_diagnosis`
--

CREATE TABLE `patient_diagnosis` (
  `id` int(11) NOT NULL,
  `diagnosis_tran_no` bigint(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `diagnosis_id` int(11) NOT NULL,
  `diagnosis_type` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_diagnosis`
--

INSERT INTO `patient_diagnosis` (`id`, `diagnosis_tran_no`, `patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `diagnosis_id`, `diagnosis_type`, `date`, `user_id`) VALUES
(1, 1, 5, 1, '2021-02-01', 2, 1, 'provissional', '2021-02-03 11:26:40', 3),
(2, 1, 5, 1, '2021-02-01', 2, 2, 'principal', '2021-02-03 11:26:40', 3),
(3, 2, 5, 1, '2021-02-01', 2, 1, 'principal', '2021-02-04 17:40:31', 3);

-- --------------------------------------------------------

--
-- Table structure for table `patient_invoice`
--

CREATE TABLE `patient_invoice` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `receipt_no` bigint(11) NOT NULL,
  `total` float NOT NULL,
  `discount` float NOT NULL,
  `grand_total` float NOT NULL,
  `paid` float NOT NULL,
  `rest` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_receipt`
--

CREATE TABLE `patient_receipt` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `tran_no` int(11) NOT NULL,
  `investigation_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_reviewed_symptoms`
--

CREATE TABLE `patient_reviewed_symptoms` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_status`
--

CREATE TABLE `patient_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_status`
--

INSERT INTO `patient_status` (`id`, `name`) VALUES
(1, 'Waiting'),
(2, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `patient_vitals_signs`
--

CREATE TABLE `patient_vitals_signs` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `vital_id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `sidebar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_sales`
--

CREATE TABLE `pharmacy_sales` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `physical_examination`
--

CREATE TABLE `physical_examination` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appearance` text NOT NULL,
  `temperature` varchar(50) NOT NULL,
  `pulse_rate` varchar(50) NOT NULL,
  `respiratory_rate` varchar(50) NOT NULL,
  `blood_pressure` varchar(50) NOT NULL,
  `weight` float NOT NULL,
  `height` float NOT NULL,
  `bmi` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `physical_examination`
--

INSERT INTO `physical_examination` (`id`, `patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `appearance`, `temperature`, `pulse_rate`, `respiratory_rate`, `blood_pressure`, `weight`, `height`, `bmi`, `date`, `user_id`) VALUES
(1, 5, 1, '2021-02-01', 2, 'Good', '78', '78', '78', '78', 78, 178, 24.618, '2021-02-02 06:50:27', 3);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `prescription_serial` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `frequency` varchar(10) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `instruction` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `prescription_serial`, `patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `drug_id`, `quantity`, `frequency`, `duration`, `instruction`, `status`, `user_id`, `date`) VALUES
(1, '1', 5, 1, '2021-02-01', 2, 1, '30', '1x3', '10', 'Oral', 'Active', 3, '2021-02-04 20:13:02'),
(2, '1', 5, 1, '2021-02-01', 2, 2, '10', '1x1', '10', 'Oral', 'Active', 3, '2021-02-04 20:13:02'),
(3, '5', 5, 1, '2021-02-01', 2, 1, '40', '4x3', '10', 'Oral', 'Active', 3, '2021-02-04 20:51:04'),
(4, '7', 5, 1, '2021-02-01', 2, 1, '10', '1x1', '10', 'Oral', 'Active', 3, '2021-02-04 21:00:23'),
(5, '8', 5, 1, '2021-02-01', 2, 1, '50', '1x1', '50', 'Oral', 'Active', 3, '2021-02-04 21:19:41'),
(6, '35', 5, 1, '2021-02-01', 2, 1, '10', '1x1', '10', 'Oral', 'Active', 3, '2021-02-05 11:08:10'),
(7, '36', 5, 1, '2021-02-01', 2, 1, '100', '1x2', '50', 'Oral', 'Active', 3, '2021-02-05 11:10:49'),
(8, '37', 5, 1, '2021-02-01', 2, 2, '100', '2x3', '14', 'Oral', 'Active', 3, '2021-02-06 04:58:36'),
(9, '38', 5, 1, '2021-02-01', 2, 1, '10', '1x1', '10', 'Oral', '', 3, '2021-02-06 08:54:05'),
(10, '39', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-07 10:14:10'),
(11, '40', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-07 10:17:12'),
(12, '41', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-07 10:20:33'),
(13, '42', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-07 10:20:53'),
(14, '43', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'oral', '', 3, '2021-02-07 10:23:52'),
(15, '44', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 05:58:03'),
(16, '45', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 05:59:17'),
(17, '46', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:01:14'),
(18, '47', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:14:59'),
(19, '48', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:16:05'),
(20, '49', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:21:22'),
(21, '50', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:23:47'),
(22, '51', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:24:44'),
(23, '52', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:29:31'),
(24, '53', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:30:50'),
(25, '54', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:31:32'),
(26, '55', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:32:21'),
(27, '56', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:39:05'),
(28, '57', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:43:23'),
(29, '58', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:44:20'),
(30, '59', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:46:08'),
(31, '60', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:47:41'),
(32, '61', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:48:52'),
(33, '62', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:49:35'),
(34, '63', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:54:20'),
(35, '64', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:55:02'),
(36, '65', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:55:25'),
(37, '66', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 06:56:50'),
(38, '67', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:00:18'),
(39, '68', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:00:56'),
(40, '69', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:01:23'),
(41, '70', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:03:19'),
(42, '71', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:03:58'),
(43, '72', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:04:18'),
(44, '73', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:05:32'),
(45, '74', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:09:09'),
(46, '75', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:12:18'),
(47, '76', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:12:49'),
(48, '77', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:14:00'),
(49, '78', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:15:26'),
(50, '79', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:16:11'),
(51, '80', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:17:19'),
(52, '81', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:17:43'),
(53, '82', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:21:22'),
(54, '83', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:24:01'),
(55, '84', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:24:51'),
(56, '85', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:26:41'),
(57, '86', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:40:43'),
(58, '87', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:45:32'),
(59, '88', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 07:46:00'),
(60, '89', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 08:36:19'),
(61, '90', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 08:37:01'),
(62, '91', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 08:40:59'),
(63, '92', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 08:44:27'),
(64, '93', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 08:52:52'),
(65, '94', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 08:54:50'),
(66, '95', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 08:56:33'),
(67, '96', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 08:59:05'),
(68, '97', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:00:30'),
(69, '98', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:06:25'),
(70, '99', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:07:10'),
(71, '100', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:08:00'),
(72, '101', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:19:20'),
(73, '102', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:21:42'),
(74, '103', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:22:15'),
(75, '104', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:22:45'),
(76, '105', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:25:52'),
(77, '106', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:27:31'),
(78, '107', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 09:28:13'),
(79, '108', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 10:08:25'),
(80, '109', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 10:14:24'),
(81, '110', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 10:14:56'),
(82, '111', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 10:15:44'),
(83, '112', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 10:16:19'),
(84, '113', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 10:17:48'),
(85, '114', 5, 1, '2021-02-01', 2, 1, '12', '1x2', '6', 'Oral', '', 3, '2021-02-08 10:19:12'),
(86, '115', 6, 1, '2021-02-08', 3, 1, '500', '1X1', '10', 'oral', '', 5, '2021-02-08 12:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_sales`
--

CREATE TABLE `prescription_sales` (
  `id` int(11) NOT NULL,
  `sales_type` varchar(50) NOT NULL DEFAULT 'Prescription Sales',
  `prescription_id` varchar(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sales_unit` varchar(50) NOT NULL,
  `qty` float NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prescription_sales`
--

INSERT INTO `prescription_sales` (`id`, `sales_type`, `prescription_id`, `invoice_no`, `product_id`, `sales_unit`, `qty`, `price`, `amount`, `date`, `user_id`) VALUES
(1, 'Prescription Sales', '1', 46, 1, ' ', 30, 0.05, 1.5, '2021-04-28 09:47:30', 1),
(2, 'Prescription Sales', '1', 46, 2, ' ', 10, 2.1, 21, '2021-04-28 09:47:30', 1),
(3, 'Prescription Sales', '1', 47, 1, ' ', 30, 0.05, 1.5, '2021-04-28 09:57:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `generic_name` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `num_strp_per_pack` int(11) DEFAULT NULL,
  `num_pills_per_pack` int(11) DEFAULT NULL,
  `num_inj_per_pack` int(11) DEFAULT NULL,
  `preferred_supplier` int(11) DEFAULT NULL,
  `purchase_cost` float DEFAULT NULL,
  `sell_price` float NOT NULL,
  `mfg_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `qty` float NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `brand_name`, `generic_name`, `category`, `country`, `num_strp_per_pack`, `num_pills_per_pack`, `num_inj_per_pack`, `preferred_supplier`, `purchase_cost`, `sell_price`, `mfg_date`, `exp_date`, `qty`, `date`, `user_id`) VALUES
(1, 'XYZ 10MG', 'XYS', 1, 10, 5, 10, NULL, 0, 2, 2.5, '1998-10-10', '2020-10-10', 1740, '2021-01-31 06:26:24', 1),
(2, 'YYHH', 'YG', 3, 1, NULL, NULL, NULL, 1, 3, 2.1, '2020-10-10', '2025-10-10', 1990, '2021-01-31 06:27:34', 1),
(3, 'zxc', 'zxc', 3, 1, NULL, NULL, NULL, 2, 0.5, 1, '2020-08-11', '2021-02-27', 4000, '2021-02-11 05:35:19', 4),
(4, 'ZXC', 'ZXC', 4, 18, NULL, NULL, 10, 2, 1.2, 1.5, '2010-10-10', '2020-10-10', 200000, '2021-02-11 11:39:46', 1),
(5, 'TEST', 'TESTIN', 3, 219, NULL, NULL, NULL, 1, 1, 1.5, '2020-10-10', '2025-10-10', 30, '2021-02-25 11:04:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase`
--

CREATE TABLE `product_purchase` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_unit` varchar(50) NOT NULL,
  `qty` float NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `purchased_date` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_purchase`
--

INSERT INTO `product_purchase` (`id`, `supplier_id`, `invoice`, `product_id`, `purchase_unit`, `qty`, `price`, `amount`, `purchased_date`, `date`, `user_id`) VALUES
(1, 1, '102030', 1, 'box', 50, 2, 100, '2021-02-24', '2021-02-25 07:23:09', 1),
(2, 1, '102030', 2, 'bottle', 2000, 3, 6000, '2021-02-24', '2021-02-25 07:23:09', 1),
(3, 1, '102030', 3, 'bottle', 4000, 0.5, 2000, '2021-02-24', '2021-02-25 09:44:19', 1),
(4, 1, '102030', 4, 'box', 20000, 1.2, 24000, '2021-02-24', '2021-02-25 09:44:19', 1),
(5, 1, '102030', 5, 'bottle', 30, 1, 30, '2021-02-24', '2021-02-25 11:04:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_sales`
--

CREATE TABLE `product_sales` (
  `id` int(11) NOT NULL,
  `sales_type` varchar(50) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `prescription_id` varchar(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sales_unit` varchar(50) NOT NULL,
  `qty` float NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_sales`
--

INSERT INTO `product_sales` (`id`, `sales_type`, `customer_id`, `customer_name`, `prescription_id`, `invoice_no`, `product_id`, `sales_unit`, `qty`, `price`, `amount`, `date`, `user_id`) VALUES
(1, 'customer', '1', '', '', 38, 1, 'item', 20, 0.05, 1, '2021-02-25 10:12:29', 1),
(2, 'customer', '1', '', '', 39, 1, 'stripe', 48, 0.5, 24, '2021-04-26 11:20:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice_info`
--

CREATE TABLE `purchase_invoice_info` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `total` float NOT NULL,
  `discount` float NOT NULL,
  `grand_total` float NOT NULL,
  `paid` float NOT NULL,
  `rest` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_invoice_info`
--

INSERT INTO `purchase_invoice_info` (`id`, `supplier_id`, `invoice`, `total`, `discount`, `grand_total`, `paid`, `rest`, `date`, `user_id`) VALUES
(1, 1, '102030', 32130, 30, 32100, 100, 32000, '2021-02-25 07:23:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_of_symptoms`
--

CREATE TABLE `review_of_symptoms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review_of_symptoms`
--

INSERT INTO `review_of_symptoms` (`id`, `name`, `user_id`, `date`) VALUES
(1, 'Endocrine', 2, '2020-06-17 11:22:24'),
(2, 'Respiratory', 2, '2020-06-17 11:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `bed` int(11) NOT NULL,
  `dept` int(11) NOT NULL,
  `cost` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `room_number`, `category`, `bed`, `dept`, `cost`, `user_id`, `date`) VALUES
(1, 1, 1, 2, 1, 10, 1, '2020-03-03 07:48:02'),
(2, 2, 1, 1, 1, 10, 2, '2020-06-14 11:43:24'),
(3, 3, 1, 1, 1, 10, 2, '2020-06-14 11:49:25'),
(4, 4, 2, 1, 1, 10, 2, '2020-06-14 11:50:44'),
(5, 5, 1, 1, 1, 10, 2, '2020-06-15 10:19:49'),
(6, 165, 4, 20, 1, 50, 2, '2020-12-09 05:59:26'),
(14, 14563, 1, 20, 1, 15, 2, '2020-12-22 10:48:02'),
(15, 10254, 9, 20, 1, 25, 2, '2020-12-27 06:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `room_category`
--

CREATE TABLE `room_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room_category`
--

INSERT INTO `room_category` (`id`, `name`, `user_id`, `date`) VALUES
(1, 'Normal Room', 1, '2020-03-03 05:53:56'),
(2, 'VIP Room', 1, '2020-03-03 05:54:30'),
(9, 'test', 2, '2020-12-22 10:46:33'),
(10, 'TESTSTS', 2, '2020-12-26 13:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoice_info`
--

CREATE TABLE `sales_invoice_info` (
  `id` int(11) NOT NULL,
  `invoice` int(11) NOT NULL,
  `sales_type` varchar(50) NOT NULL,
  `total` float NOT NULL,
  `discount` float NOT NULL,
  `grand_total` float NOT NULL,
  `paid` float NOT NULL,
  `rest` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_invoice_info`
--

INSERT INTO `sales_invoice_info` (`id`, `invoice`, `sales_type`, `total`, `discount`, `grand_total`, `paid`, `rest`, `date`, `user_id`) VALUES
(1, 38, 'customer', 1, 0, 1, 0, 1, '2021-02-25 10:12:29', 1),
(2, 39, 'customer', 24, 0, 24, 0, 24, '2021-04-26 11:20:41', 1),
(3, 41, 'cash', 0.5, 0, 0.5, 0.5, 0, '2021-04-26 13:31:25', 1),
(4, 42, 'customer', 4.5, 0, 4.5, 0, 4.5, '2021-04-28 08:57:20', 1),
(5, 43, 'customer', 5, 0, 5, 0, 5, '2021-04-28 08:58:17', 1),
(6, 46, 'cash', 22.5, 0, 22.5, 22.5, 0, '2021-04-28 09:47:30', 1),
(7, 47, 'Prescription', 1.5, 0, 1.5, 1.5, 0, '2021-04-28 09:57:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `user_id`, `date`) VALUES
(1, 'General', 4, '2021-02-03 07:07:02'),
(2, 'Dental', 4, '2021-02-03 07:07:18'),
(3, 'ENT', 4, '2021-02-03 07:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `services_request`
--

CREATE TABLE `services_request` (
  `id` int(11) NOT NULL,
  `service_tran_no` bigint(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `service_test_id` int(11) NOT NULL,
  `service_status` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services_request`
--

INSERT INTO `services_request` (`id`, `service_tran_no`, `patient_id`, `ticket_no`, `visit_date`, `doctor_id`, `service_test_id`, `service_status`, `date`, `user_id`) VALUES
(1, 2, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-03 08:08:59', 3),
(2, 2, 5, 1, '2021-02-01', 2, 2, 'Ordered', '2021-02-03 08:08:59', 3),
(3, 2, 5, 1, '2021-02-01', 2, 3, 'Ordered', '2021-02-03 08:08:59', 3),
(4, 3, 0, 0, '2021-02-01', 2, 1, 'Ordered', '2021-02-03 10:33:30', 3),
(5, 3, 0, 0, '2021-02-01', 2, 2, 'Ordered', '2021-02-03 10:33:30', 3),
(6, 4, 0, 0, '2021-02-01', 2, 3, 'Ordered', '2021-02-03 10:38:15', 3),
(7, 5, 0, 0, '2021-02-01', 2, 3, 'Ordered', '2021-02-03 10:38:35', 3),
(8, 6, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-03 10:41:17', 3),
(9, 6, 5, 1, '2021-02-01', 2, 2, 'Ordered', '2021-02-03 10:41:17', 3),
(10, 7, 5, 1, '2021-02-01', 2, 3, 'Ordered', '2021-02-04 17:42:27', 3),
(11, 8, 5, 1, '2021-02-01', 2, 1, 'Ordered', '2021-02-06 10:37:03', 3),
(12, 8, 5, 1, '2021-02-01', 2, 2, 'Ordered', '2021-02-06 10:37:03', 3);

--
-- Triggers `services_request`
--
DELIMITER $$
CREATE TRIGGER `service_charge` AFTER INSERT ON `services_request` FOR EACH ROW BEGIN
SELECT name,amount INTO @name,@amount FROM service_type WHERE id = new.service_test_id;
INSERT INTO patient_charge  (`patient_id`,`type`, `investigation`, `amount`) VALUES (new.patient_id,'service',@name,@amount);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

CREATE TABLE `service_type` (
  `id` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_type`
--

INSERT INTO `service_type` (`id`, `service`, `name`, `amount`, `user_id`, `date`) VALUES
(1, 1, 'Day Care', 3, 4, '2021-02-03 07:09:15'),
(2, 1, 'Dressing for head injiy ', 5, 4, '2021-02-03 07:10:59'),
(3, 1, 'Catheterization', 2, 4, '2021-02-03 07:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `setup`
--

CREATE TABLE `setup` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setup`
--

INSERT INTO `setup` (`id`, `name`, `value`) VALUES
(1, 'prescription_serial', '116'),
(2, 'invoice', '47'),
(3, 'lab_tran_no', '20'),
(5, 'image_tran_no', '10'),
(6, 'service_tran_no', '10'),
(7, 'diagnosis_tran_no', '3');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `name`, `user_id`, `date`) VALUES
(1, 'Morning', 2, '2020-12-12 08:28:22'),
(2, 'Mid Night', 2, '2020-12-12 08:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE `sidebar` (
  `id` int(11) NOT NULL,
  `href` varchar(50) NOT NULL,
  `text` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `menu_icon` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specialist`
--

CREATE TABLE `specialist` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `specialist`
--

INSERT INTO `specialist` (`id`, `name`, `user_id`, `date`) VALUES
(1, 'Internal medicine specialist', 1, '2020-03-01 05:26:15'),
(2, 'Obgyn specialist', 1, '2020-03-01 05:24:47'),
(7, 'Orthopedic', 2, '2021-02-08 10:50:10'),
(8, 'test123', 2, '2020-12-22 08:19:38'),
(9, 'TEST123456', 2, '2020-12-26 11:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `stuff`
--

CREATE TABLE `stuff` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `tell` varchar(50) NOT NULL,
  `department` int(11) NOT NULL,
  `designation` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `office_tell` varchar(50) NOT NULL,
  `gender` int(11) NOT NULL,
  `blood_group` int(11) NOT NULL,
  `biography` varchar(200) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stuff`
--

INSERT INTO `stuff` (`id`, `full_name`, `email`, `address`, `tell`, `department`, `designation`, `shift`, `office_tell`, `gender`, `blood_group`, `biography`, `Image`, `user_id`, `date`) VALUES
(2, 'Yuushac Bin Musa ', 'yuushac@gmail.com', '12', '12', 1, 2, 1, '1212', 1, 2, '121212', 'img/user/ab9.jpg', 2, '2020-12-12 08:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `tell` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `tell`, `email`, `address`, `date`, `user_id`) VALUES
(1, 'ABC Company', '618454556', 'abc@gmail.com', 'Hodan', '2021-01-31 06:24:57', 1),
(2, 'Cadceed Bussiness Group', '0615353625', 'cadceed400@gmail.com', 'Mogadishu', '2021-02-04 06:25:53', 4);

--
-- Triggers `supplier`
--
DELIMITER $$
CREATE TRIGGER `insert_account_payable` AFTER INSERT ON `supplier` FOR EACH ROW BEGIN
INSERT INTO account_payable(account_payable.supplier_id,account_payable.amount) VALUES(new.id,0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_invoice`
--

CREATE TABLE `supplier_invoice` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `total` float NOT NULL,
  `discount` float NOT NULL,
  `sub_total` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `lab`, `name`, `amount`, `user_id`, `date`) VALUES
(1, 3, 'Blood Group', 1, 1, '2020-12-21 10:07:20'),
(2, 3, 'Hb', 1, 1, '2020-12-21 10:07:40'),
(3, 3, 'Malaria', 1, 1, '2020-12-21 10:07:40'),
(4, 9, 'Urine', 1, 1, '2020-12-21 10:07:40'),
(5, 8, 'Stool Examination', 1, 1, '2020-12-21 10:07:40'),
(6, 7, 'HIV', 1, 1, '2020-12-21 10:07:40'),
(7, 7, 'ASO Serology', 1, 1, '2020-12-21 10:07:40'),
(8, 6, 'Biopsies', 1, 1, '2020-12-21 10:07:40'),
(9, 6, 'Blood Culture', 1, 1, '2020-12-21 10:07:40'),
(10, 6, 'Urine Culture', 1, 1, '2020-12-21 10:07:40'),
(11, 18, 't', 1, 2, '2020-12-21 10:07:40'),
(12, 3, 'Test', 1.5, 2, '2020-12-21 10:11:05'),
(13, 23, 'Test Lee', 1.25, 2, '2020-12-28 06:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `cost` float NOT NULL,
  `p_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `ticket_no`, `patient_id`, `doctor`, `cost`, `p_status`, `user_id`, `date`) VALUES
(1, 1, 1, 1, 10, 1, 0, '2021-01-21 07:41:43'),
(2, 2, 2, 1, 10, 1, 0, '2021-01-21 07:51:39'),
(3, 1, 2, 2, 15, 1, 0, '2021-01-21 07:56:10'),
(4, 3, 3, 1, 10, 1, 1, '2021-01-21 10:26:29'),
(5, 1, 1, 1, 10, 1, 1, '2021-01-23 06:45:24'),
(6, 1, 3, 1, 10, 1, 1, '2021-01-24 05:16:59'),
(7, 1, 1, 1, 10, 1, 1, '2021-01-25 06:20:10'),
(8, 1, 1, 1, 10, 1, 1, '2021-01-26 06:15:00'),
(9, 1, 1, 1, 10, 1, 1, '2021-01-27 05:42:43'),
(10, 2, 2, 1, 10, 1, 1, '2021-01-27 10:31:20'),
(11, 3, 3, 1, 10, 1, 1, '2021-01-27 11:12:15'),
(12, 4, 4, 1, 10, 1, 1, '2021-01-27 11:36:28'),
(13, 1, 1, 1, 10, 1, 1, '2021-01-28 07:49:15'),
(14, 1, 1, 1, 10, 1, 1, '2021-01-30 05:36:07'),
(15, 2, 2, 1, 10, 1, 1, '2021-01-30 06:25:02'),
(16, 1, 5, 2, 15, 1, 4, '2021-02-01 07:03:12'),
(17, 1, 6, 3, 15, 1, 6, '2021-02-08 11:56:20'),
(18, 1, 7, 2, 15, 1, 4, '2021-02-09 11:16:15'),
(19, 1, 8, 1, 10, 1, 4, '2021-02-09 11:33:21'),
(20, 2, 9, 1, 10, 1, 4, '2021-02-09 11:36:18'),
(21, 2, 10, 2, 15, 1, 4, '2021-02-09 11:40:01');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_type` varchar(50) NOT NULL,
  `total` float NOT NULL,
  `discount` float NOT NULL,
  `paid` float NOT NULL,
  `rest` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unit_measure`
--

CREATE TABLE `unit_measure` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `usertype` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `Image` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `registered_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `usertype`, `username`, `pass`, `Image`, `status`, `date`, `registered_user_id`) VALUES
(1, 1, 1, 'aamadan2', '202cb962ac59075b964b07152d234b70', 'images/admin.png', 1, '2021-01-18 07:08:33', 1),
(2, 1, 2, 'aamadan', '202cb962ac59075b964b07152d234b70', 'images/avatar.png', 1, '2021-01-19 08:04:03', 1),
(3, 2, 2, 'isse', '202cb962ac59075b964b07152d234b70', 'images/avatar.png', 1, '2021-01-21 07:53:22', 0),
(4, 4, 1, 'saciid', 'db11dac5a9c6fc7061b800475fe09277', '	 images/avatar.png', 1, '2021-02-01 06:22:36', 0),
(5, 3, 2, 'sayid', '025b6f7e18f7ebe5c8277cfa904fa742', 'images/dr sayid omar.jpeg', 1, '2021-02-08 10:54:29', 4),
(6, 5, 1, 'manager', '21a964a3fb1282cf743c31ca53f1e733', 'images/dr sayid omar.jpeg', 1, '2021-02-08 11:01:09', 4);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Doctor');

-- --------------------------------------------------------

--
-- Table structure for table `user_code`
--

CREATE TABLE `user_code` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vital_signs`
--

CREATE TABLE `vital_signs` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vital_signs`
--

INSERT INTO `vital_signs` (`id`, `name`, `user_id`, `date`) VALUES
(1, 'Weight ', 2, '2020-06-17 11:14:04'),
(3, 'Height', 2, '2020-06-27 10:57:30'),
(4, 'BMI', 2, '2020-06-27 10:57:38'),
(5, 'BP', 2, '2020-06-27 11:25:23'),
(6, 'Heights', 2, '2020-12-09 06:07:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_payable`
--
ALTER TABLE `account_payable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_receivable`
--
ALTER TABLE `account_receivable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_sales`
--
ALTER TABLE `cash_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinicaldata`
--
ALTER TABLE `clinicaldata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_sales`
--
ALTER TABLE `customer_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug`
--
ALTER TABLE `drug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug_category`
--
ALTER TABLE `drug_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_taking`
--
ALTER TABLE `history_taking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_request`
--
ALTER TABLE `image_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_request`
--
ALTER TABLE `lab_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marital_status`
--
ALTER TABLE `marital_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketer`
--
ALTER TABLE `marketer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_charge`
--
ALTER TABLE `patient_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_diagnosis`
--
ALTER TABLE `patient_diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_invoice`
--
ALTER TABLE `patient_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_receipt`
--
ALTER TABLE `patient_receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_reviewed_symptoms`
--
ALTER TABLE `patient_reviewed_symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_status`
--
ALTER TABLE `patient_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_vitals_signs`
--
ALTER TABLE `patient_vitals_signs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sidebar_id` (`sidebar_id`,`user_id`);

--
-- Indexes for table `pharmacy_sales`
--
ALTER TABLE `pharmacy_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `physical_examination`
--
ALTER TABLE `physical_examination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription_sales`
--
ALTER TABLE `prescription_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_purchase`
--
ALTER TABLE `product_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_invoice_info`
--
ALTER TABLE `purchase_invoice_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_of_symptoms`
--
ALTER TABLE `review_of_symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_category`
--
ALTER TABLE `room_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_invoice_info`
--
ALTER TABLE `sales_invoice_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `services_request`
--
ALTER TABLE `services_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_type`
--
ALTER TABLE `service_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup`
--
ALTER TABLE `setup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sidebar`
--
ALTER TABLE `sidebar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stuff`
--
ALTER TABLE `stuff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_measure`
--
ALTER TABLE `unit_measure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_code`
--
ALTER TABLE `user_code`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `vital_signs`
--
ALTER TABLE `vital_signs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_payable`
--
ALTER TABLE `account_payable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `account_receivable`
--
ALTER TABLE `account_receivable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cash_sales`
--
ALTER TABLE `cash_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clinicaldata`
--
ALTER TABLE `clinicaldata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_sales`
--
ALTER TABLE `customer_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drug`
--
ALTER TABLE `drug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drug_category`
--
ALTER TABLE `drug_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history_taking`
--
ALTER TABLE `history_taking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `image_request`
--
ALTER TABLE `image_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `lab_request`
--
ALTER TABLE `lab_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `marital_status`
--
ALTER TABLE `marital_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marketer`
--
ALTER TABLE `marketer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_charge`
--
ALTER TABLE `patient_charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_diagnosis`
--
ALTER TABLE `patient_diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient_invoice`
--
ALTER TABLE `patient_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_receipt`
--
ALTER TABLE `patient_receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_reviewed_symptoms`
--
ALTER TABLE `patient_reviewed_symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_status`
--
ALTER TABLE `patient_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_vitals_signs`
--
ALTER TABLE `patient_vitals_signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_sales`
--
ALTER TABLE `pharmacy_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `physical_examination`
--
ALTER TABLE `physical_examination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `prescription_sales`
--
ALTER TABLE `prescription_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_purchase`
--
ALTER TABLE `product_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_invoice_info`
--
ALTER TABLE `purchase_invoice_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review_of_symptoms`
--
ALTER TABLE `review_of_symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `room_category`
--
ALTER TABLE `room_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales_invoice_info`
--
ALTER TABLE `sales_invoice_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services_request`
--
ALTER TABLE `services_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `service_type`
--
ALTER TABLE `service_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setup`
--
ALTER TABLE `setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sidebar`
--
ALTER TABLE `sidebar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specialist`
--
ALTER TABLE `specialist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stuff`
--
ALTER TABLE `stuff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `unit_measure`
--
ALTER TABLE `unit_measure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_code`
--
ALTER TABLE `user_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vital_signs`
--
ALTER TABLE `vital_signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
