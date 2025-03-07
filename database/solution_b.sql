--1. Liệt kê các hóa đơn của khách hàng, thông tin hiển thị gồm: mã user, tên user, mã hóa đơn
go

SELECT users.user_id, users.user_name, orders.order_id
FROM users, orders
WHERE users.user_id = orders.user_id

--2. Liệt kê số lượng các hóa đơn của khách hàng: mã user, tên user, số đơn hàng
go
SELECT users.user_id, users.user_name, COUNT(orders.order_id) as 'Số đơn hàng' FROM users, orders WHERE users.user_id = orders.user_id GROUP BY users.user_id;

--3. Liệt kê thông tin hóa đơn: mã đơn hàng, số sản phẩm
go

SELECT orders.order_id, COUNT(order_details.product_id) as 'So san pham' FROM order_details, orders WHERE orders.order_id = order_details.order_id GROUP BY orders.order_id;

--4. Liệt kê thông tin mua hàng của người dùng: mã user, tên user, mã đơn hàng, tên sản phẩm. Lưu ý: gôm nhóm theo đơn hàng, tránh hiển thị xen kẻ các đơn hàng với nhau

go 

SELECT users.user_id , users.user_name , order_details.order_details_id , products.product_name
FROM order_details, orders, users,products
WHERE orders.order_id = order_details.order_id and orders.user_id = users.user_id and order_details.product_id = products.product_id



--5. Liệt kê 7 người dùng có số lượng đơn hàng nhiều nhất, thông tin hiển thị gồm: mã user, tên user, số lượng đơn hàng
go
SELECT users.user_id, users.user_name, COUNT(orders.order_id) as 'So luong don hang' FROM users, orders WHERE users.user_id = orders.user_id GROUP BY users.user_id, users.user_name ORDER BY COUNT(orders.order_id) DESC LIMIT 7;


--6. Liệt kê 7 người dùng mua sản phẩm có tên: Samsung hoặc Apple trong tên sản
phẩm, thông tin hiển thị gồm: mã user, tên user, mã đơn hàng, tên sản phẩm

go 
SELECT users.user_id, users.user_name, orders.order_id, products.product_name
FROM users, orders, order_details, products
WHERE users.user_id = orders.user_id and orders.order_id = order_details.order_id and order_details.product_id = products.product_id and (products.product_name LIKE "%Samsung%" or products.product_name LIKE "%Apple%")

--7. Liệt kê danh sách mua hàng của user bao gồm giá tiền của mỗi đơn hàng, thông tin hiển thị gồm: mã user, tên user, mã đơn hàng, tổng tiền
go 
SELECT users.user_id, users.user_name, orders.order_id, SUM(products.product_price) as 'Tong tien'
FROM users, orders, order_details, products
WHERE users.user_id = orders.user_id and orders.order_id = order_details.order_id and order_details.product_id = products.product_id
GROUP BY users.user_id, users.user_name, orders.order_id

--8. Liệt kê danh sách mua hàng của user bao gồm giá tiền của mỗi đơn hàng, thông tin hiển thị gồm: mã user, tên user, mã đơn hàng, tổng tiền. Mỗi user chỉ chọn ra 1 đơn hàng có giá tiền lớn nhất. 
go
SELECT users.user_id, users.user_name, orders.order_id, SUM(products.product_price) as 'Tong tien'
FROM users, orders, order_details, products
WHERE users.user_id = orders.user_id and orders.order_id = order_details.order_id and order_details.product_id = products.product_id
GROUP BY users.user_id, users.user_name, orders.order_id
ORDER BY users.user_id, SUM(products.product_price) DESC

--9. Liệt kê danh sách mua hàng của user bao gồm giá tiền của mỗi đơn hàng, thông tin hiển thị gồm: mã user, tên user, mã đơn hàng, tổng tiền, số sản phẩm. Mỗi user chỉ chọn ra 1 đơn hàng có giá tiền nhỏ nhất.

go


-- 10. Liệt kê danh sách mua hàng của user bao gồm giá tiền của mỗi đơn hàng, thông tin hiển thị gồm: mã user, tên user, mã đơn hàng, tổng tiền, số sản phẩm. Mỗi user chỉ chọn ra 1 đơn hàng có số sản phẩm là nhiều nhất.
go




