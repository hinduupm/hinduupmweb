CREATE TABLE activity_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

CREATE TABLE activity_place (
    place_id INT AUTO_INCREMENT PRIMARY KEY,
    place_name VARCHAR(255) NOT NULL UNIQUE,
    sabai TEXT
);


insert into activity_types (type_name, description) VALUES ('Hospital Annadhanam' , 'Annadhanam done in Govt. Hospitals');
insert into activity_types (type_name, description) VALUES ('Temple Annadhanam' , 'Annadhanam done in Temples');
insert into activity_types (type_name, description) VALUES ('Dhiyaana Sabai Annadhanam' , 'Annadhanam done in Our Sabai');
insert into activity_types (type_name, description) VALUES ('Thai Poosam Annadhanam' , 'Annadhanam done during Thai Poosam');
insert into activity_types (type_name, description) VALUES ('Door to Door Divine Messages' , 'Posting divine messages door to door');
insert into activity_types (type_name, description) VALUES ('Temple Divine Messages' , 'Painting Divine Messages in Temple Walls');
insert into activity_types (type_name, description) VALUES ('Auto/Shops Divine Stickers' , 'Posting divine messages in Auto, Vehicles and Shops');
insert into activity_types (type_name, description) VALUES ('Yoga Classes' , 'Free Yoga classes in schools');
insert into activity_types (type_name, description) VALUES ('Meditation Classes' , 'Free Meditation classes');
insert into activity_types (type_name, description) VALUES ('Others' , 'Other spiritual activities');


insert into activity_place (place_name, description) values ('Chennai' , 'Tambaram Sabai');
insert into activity_place (place_name, description) values ('Kanchipuram' , 'Nathanallur Sabai'); 
insert into activity_place (place_name, description) values ('Nathanallur' , 'Nathanallur Sabai'); 
insert into activity_place (place_name, description) values ('Tirunelveli' , 'Rastha Sabai'); 
insert into activity_place (place_name, description) values ('Kolkata' , 'Kolkata Sabai'); 
insert into activity_place (place_name, description) values ('Marakkanam' , 'Villupuram Sabai'); 
insert into activity_place (place_name, description) values ('Arakkonam' , 'Panappakkam Sabai'); 

ALTER TABLE spiritual_activities ADD activity_type_id INT;
UPDATE spiritual_activities
SET activity_type_id = (
    SELECT id FROM activity_types WHERE type_name = spiritual_activities.activity_type
);

ALTER TABLE spiritual_activities ADD activity_type_id INT;
UPDATE spiritual_activities
SET activity_place_id = (
    SELECT place_id FROM activity_place WHERE place_name = spiritual_activities.place
);
