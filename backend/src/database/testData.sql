-- 1. Insert Currencies (Needed by Prices)
INSERT INTO Currencies (currency_label, symbol) VALUES
('USD', '$');

-- Assuming 'USD' gets currency_label = 'USD'

-- 2. Insert Categories (Needed by Products)
INSERT INTO Categories (name) VALUES
('all'),
('clothes'),
('tech');

-- Assuming 'all' gets category_id = 1, 'clothes' = 2, 'tech' = 3

-- 3. Insert Attribute Sets (Needed by Attributes)
INSERT INTO Attribute_Sets (json_id, name, type) VALUES
('Size', 'Size', 'text'),
('Color', 'Color', 'swatch'),
('Capacity', 'Capacity', 'text'),
('With USB 3 ports', 'With USB 3 ports', 'text'),
('Touch ID in keyboard', 'Touch ID in keyboard', 'text');

-- Assuming 'Size' gets attribute_set_id = 1, 'Color' = 2, 'Capacity' = 3, 'With USB 3 ports' = 4, 'Touch ID in keyboard' = 5

-- 4. Insert Attribute Values (Needed by Product_Attributes)
-- Size values (attribute_set_id = 1)
INSERT INTO Attributes (attribute_set_id, json_id, display_value, value) VALUES
(1, '40', '40', '40'),
(1, '41', '41', '41'),
(1, '42', '42', '42'),
(1, '43', '43', '43'),
(1, 'Small', 'Small', 'S'),
(1, 'Medium', 'Medium', 'M'),
(1, 'Large', 'Large', 'L'),
(1, 'Extra Large', 'Extra Large', 'XL');
-- Color values (attribute_set_id = 2)
INSERT INTO Attributes (attribute_set_id, json_id, display_value, value) VALUES
(2, 'Green', 'Green', '#44FF03'),
(2, 'Cyan', 'Cyan', '#03FFF7'),
(2, 'Blue', 'Blue', '#030BFF'),
(2, 'Black', 'Black', '#000000'),
(2, 'White', 'White', '#FFFFFF');
-- Capacity values (attribute_set_id = 3)
INSERT INTO Attributes (attribute_set_id, json_id, display_value, value) VALUES
(3, '512G', '512G', '512G'),
(3, '1T', '1T', '1T'),
(3, '256GB', '256GB', '256GB'),
(3, '512GB', '512GB', '512GB');
-- With USB 3 ports values (attribute_set_id = 4)
INSERT INTO Attributes (attribute_set_id, json_id, display_value, value) VALUES
(4, 'Yes', 'Yes', 'Yes'),
(4, 'No', 'No', 'No');
-- Touch ID in keyboard values (attribute_set_id = 5)
INSERT INTO Attributes (attribute_set_id, json_id, display_value, value) VALUES
(5, 'Yes', 'Yes', 'Yes'),
(5, 'No', 'No', 'No');

-- Assuming the above inserts result in sequential attribute_id's from 1 to 22.
-- We'll need these IDs for the Product_Attributes table below.
-- 1-4: Sizes 40-43
-- 5-8: Sizes S-XL
-- 9-13: Colors Green-White
-- 14-17: Capacities 512G, 1T, 256GB, 512GB
-- 18-19: USB Yes/No
-- 20-21: Touch ID Yes/No (Oops, mistake in counting, previous row was 18/19, this is 20/21) -> Re-count: 1-4 (4), 5-8 (4), 9-13 (5), 14-17 (4), 18-19 (2), 20-21 (2) = Total 21 values. OK.


-- 5. Insert Products (Needs category_id lookup)
INSERT INTO Products (product_id, name, inStock, description, category_id, brand) VALUES
('huarache-x-stussy-le', 'Nike Air Huarache Le', TRUE, '<p>Great sneakers for everyday use!</p>', 2, 'Nike x Stussy'),
('jacket-canada-goosee', 'Jacket', TRUE, '<p>Awesome winter jacket</p>', 2, 'Canada Goose'),
('ps-5', 'PlayStation 5', TRUE, '<p>A good gaming console. Plays games of PS4! Enjoy if you can buy it mwahahahaha</p>', 3, 'Sony'),
('xbox-series-s', 'Xbox Series S 512GB', FALSE, '\n<div>\n    <ul>\n        <li><span>Hardware-beschleunigtes Raytracing macht dein Spiel noch realistischer</span></li>\n        <li><span>Spiele Games mit bis zu 120 Bilder pro Sekunde</span></li>\n        <li><span>Minimiere Ladezeiten mit einer speziell entwickelten 512GB NVMe SSD und wechsle mit Quick Resume nahtlos zwischen mehreren Spielen.</span></li>\n        <li><span>Xbox Smart Delivery stellt sicher, dass du die beste Version deines Spiels spielst, egal, auf welcher Konsole du spielst</span></li>\n        <li><span>Spiele deine Xbox One-Spiele auf deiner Xbox Series S weiter. Deine Fortschritte, Erfolge und Freundesliste werden automatisch auf das neue System übertragen.</span></li>\n        <li><span>Erwecke deine Spiele und Filme mit innovativem 3D Raumklang zum Leben</span></li>\n        <li><span>Der brandneue Xbox Wireless Controller zeichnet sich durch höchste Präzision, eine neue Share-Taste und verbesserte Ergonomie aus</span></li>\n        <li><span>Ultra-niedrige Latenz verbessert die Reaktionszeit von Controller zum Fernseher</span></li>\n        <li><span>Verwende dein Xbox One-Gaming-Zubehör -einschließlich Controller, Headsets und mehr</span></li>\n        <li><span>Erweitere deinen Speicher mit der Seagate 1 TB-Erweiterungskarte für Xbox Series X (separat erhältlich) und streame 4K-Videos von Disney+, Netflix, Amazon, Microsoft Movies &amp; TV und mehr</span></li>\n    </ul>\n</div>', 3, 'Microsoft'),
('apple-imac-2021', 'iMac 2021', TRUE, 'The new iMac!', 3, 'Apple'),
('apple-iphone-12-pro', 'iPhone 12 Pro', TRUE, 'This is iPhone 12. Nothing else to say.', 3, 'Apple'),
('apple-airpods-pro', 'AirPods Pro', FALSE, '\n<h3>Magic like you’ve never heard</h3>\n<p>AirPods Pro have been designed to deliver Active Noise Cancellation for immersive sound, Transparency mode so you can hear your surroundings, and a customizable fit for all-day comfort. Just like AirPods, AirPods Pro connect magically to your iPhone or Apple Watch. And they’re ready to use right out of the case.\n\n<h3>Active Noise Cancellation</h3>\n<p>Incredibly light noise-cancelling headphones, AirPods Pro block out your environment so you can focus on what you’re listening to. AirPods Pro use two microphones, an outward-facing microphone and an inward-facing microphone, to create superior noise cancellation. By continuously adapting to the geometry of your ear and the fit of the ear tips, Active Noise Cancellation silences the world to keep you fully tuned in to your music, podcasts, and calls.\n\n<h3>Transparency mode</h3>\n<p>Switch to Transparency mode and AirPods Pro let the outside sound in, allowing you to hear and connect to your surroundings. Outward- and inward-facing microphones enable AirPods Pro to undo the sound-isolating effect of the silicone tips so things sound and feel natural, like when you’re talking to people around you.</p>\n\n<h3>All-new design</h3>\n<p>AirPods Pro offer a more customizable fit with three sizes of flexible silicone tips to choose from. With an internal taper, they conform to the shape of your ear, securing your AirPods Pro in place and creating an exceptional seal for superior noise cancellation.</p>\n\n<h3>Amazing audio quality</h3>\n<p>A custom-built high-excursion, low-distortion driver delivers powerful bass. A superefficient high dynamic range amplifier produces pure, incredibly clear sound while also extending battery life. And Adaptive EQ automatically tunes music to suit the shape of your ear for a rich, consistent listening experience.</p>\n\n<h3>Even more magical</h3>\n<p>The Apple-designed H1 chip delivers incredibly low audio latency. A force sensor on the stem makes it easy to control music and calls and switch between Active Noise Cancellation and Transparency mode. Announce Messages with Siri gives you the option to have Siri read your messages through your AirPods. And with Audio Sharing, you and a friend can share the same audio stream on two sets of AirPods — so you can play a game, watch a movie, or listen to a song together.</p>\n', 3, 'Apple'),
('apple-airtag', 'AirTag', TRUE, '\n<h1>Lose your knack for losing things.</h1>\n<p>AirTag is an easy way to keep track of your stuff. Attach one to your keys, slip another one in your backpack. And just like that, they’re on your radar in the Find My app. AirTag has your back.</p>\n', 3, 'Apple');

-- 6. Insert Prices (Needs product_id and currency_label)
INSERT INTO Prices (product_id, amount, currency_label) VALUES
('huarache-x-stussy-le', 144.69, 'USD'),
('jacket-canada-goosee', 518.47, 'USD'),
('ps-5', 844.02, 'USD'),
('xbox-series-s', 333.99, 'USD'),
('apple-imac-2021', 1688.03, 'USD'),
('apple-iphone-12-pro', 1000.76, 'USD'),
('apple-airpods-pro', 300.23, 'USD'),
('apple-airtag', 120.57, 'USD');

-- 7. Insert Product Gallery (Needs product_id)
-- Huarache
INSERT INTO Product_Gallery (product_id, image_url) VALUES
('huarache-x-stussy-le', 'https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_2_720x.jpg?v=1612816087'),
('huarache-x-stussy-le', 'https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_1_720x.jpg?v=1612816087'),
('huarache-x-stussy-le', 'https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_3_720x.jpg?v=1612816087'),
('huarache-x-stussy-le', 'https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_5_720x.jpg?v=1612816087'),
('huarache-x-stussy-le', 'https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_4_720x.jpg?v=1612816087');
-- Jacket
INSERT INTO Product_Gallery (product_id, image_url) VALUES
('jacket-canada-goosee', 'https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg'),
('jacket-canada-goosee', 'https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016107/product-image/2409L_61_a.jpg'),
('jacket-canada-goosee', 'https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016108/product-image/2409L_61_b.jpg'),
('jacket-canada-goosee', 'https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016109/product-image/2409L_61_c.jpg'),
('jacket-canada-goosee', 'https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016110/product-image/2409L_61_d.jpg'),
('jacket-canada-goosee', 'https://images.canadagoose.com/image/upload/w_1333,c_scale,f_auto,q_auto:best/v1634058169/product-image/2409L_61_o.png'),
('jacket-canada-goosee', 'https://images.canadagoose.com/image/upload/w_1333,c_scale,f_auto,q_auto:best/v1634058159/product-image/2409L_61_p.png');
-- PS5
INSERT INTO Product_Gallery (product_id, image_url) VALUES
('ps-5', 'https://images-na.ssl-images-amazon.com/images/I/510VSJ9mWDL._SL1262_.jpg'),
('ps-5', 'https://images-na.ssl-images-amazon.com/images/I/610%2B69ZsKCL._SL1500_.jpg'),
('ps-5', 'https://images-na.ssl-images-amazon.com/images/I/51iPoFwQT3L._SL1230_.jpg'),
('ps-5', 'https://images-na.ssl-images-amazon.com/images/I/61qbqFcvoNL._SL1500_.jpg'),
('ps-5', 'https://images-na.ssl-images-amazon.com/images/I/51HCjA3rqYL._SL1230_.jpg');
-- Xbox
INSERT INTO Product_Gallery (product_id, image_url) VALUES
('xbox-series-s', 'https://images-na.ssl-images-amazon.com/images/I/71vPCX0bS-L._SL1500_.jpg'),
('xbox-series-s', 'https://images-na.ssl-images-amazon.com/images/I/71q7JTbRTpL._SL1500_.jpg'),
('xbox-series-s', 'https://images-na.ssl-images-amazon.com/images/I/71iQ4HGHtsL._SL1500_.jpg'),
('xbox-series-s', 'https://images-na.ssl-images-amazon.com/images/I/61IYrCrBzxL._SL1500_.jpg'),
('xbox-series-s', 'https://images-na.ssl-images-amazon.com/images/I/61RnXmpAmIL._SL1500_.jpg');
-- iMac
INSERT INTO Product_Gallery (product_id, image_url) VALUES
('apple-imac-2021', 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/imac-24-blue-selection-hero-202104?wid=904&hei=840&fmt=jpeg&qlt=80&.v=1617492405000');
-- iPhone
INSERT INTO Product_Gallery (product_id, image_url) VALUES
('apple-iphone-12-pro', 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-12-pro-family-hero?wid=940&amp;hei=1112&amp;fmt=jpeg&amp;qlt=80&amp;.v=1604021663000');
-- AirPods Pro
INSERT INTO Product_Gallery (product_id, image_url) VALUES
('apple-airpods-pro', 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/MWP22?wid=572&hei=572&fmt=jpeg&qlt=95&.v=1591634795000');
-- AirTag
INSERT INTO Product_Gallery (product_id, image_url) VALUES
('apple-airtag', 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/airtag-double-select-202104?wid=445&hei=370&fmt=jpeg&qlt=95&.v=1617761672000');


-- 8. Insert Product Attributes (Needs product_id and attribute_id lookup - using assumed IDs from step 4)
-- Huarache (Sizes 40-43 -> IDs 1-4)
INSERT INTO Product_Attributes (product_id, attribute_id) VALUES
('huarache-x-stussy-le', 1), ('huarache-x-stussy-le', 2), ('huarache-x-stussy-le', 3), ('huarache-x-stussy-le', 4);
-- Jacket (Sizes S-XL -> IDs 5-8)
INSERT INTO Product_Attributes (product_id, attribute_id) VALUES
('jacket-canada-goosee', 5), ('jacket-canada-goosee', 6), ('jacket-canada-goosee', 7), ('jacket-canada-goosee', 8);
-- PS5 (Colors Green-White -> IDs 9-13, Capacities 512G, 1T -> IDs 14, 15)
INSERT INTO Product_Attributes (product_id, attribute_id) VALUES
('ps-5', 9), ('ps-5', 10), ('ps-5', 11), ('ps-5', 12), ('ps-5', 13),
('ps-5', 14), ('ps-5', 15);
-- Xbox (Colors Green-White -> IDs 9-13, Capacities 512G, 1T -> IDs 14, 15)
INSERT INTO Product_Attributes (product_id, attribute_id) VALUES
('xbox-series-s', 9), ('xbox-series-s', 10), ('xbox-series-s', 11), ('xbox-series-s', 12), ('xbox-series-s', 13),
('xbox-series-s', 14), ('xbox-series-s', 15);
-- iMac (Capacities 256GB, 512GB -> IDs 16, 17, USB Yes/No -> IDs 18, 19, Touch ID Yes/No -> IDs 20, 21)
INSERT INTO Product_Attributes (product_id, attribute_id) VALUES
('apple-imac-2021', 16), ('apple-imac-2021', 17),
('apple-imac-2021', 18), ('apple-imac-2021', 19),
('apple-imac-2021', 20), ('apple-imac-2021', 21);
-- iPhone (Capacities 512G, 1T -> IDs 14, 15, Colors Green-White -> IDs 9-13)
INSERT INTO Product_Attributes (product_id, attribute_id) VALUES
('apple-iphone-12-pro', 14), ('apple-iphone-12-pro', 15),
('apple-iphone-12-pro', 9), ('apple-iphone-12-pro', 10), ('apple-iphone-12-pro', 11), ('apple-iphone-12-pro', 12), ('apple-iphone-12-pro', 13);
-- AirPods Pro (No attributes in JSON)
-- AirTag (No attributes in JSON)