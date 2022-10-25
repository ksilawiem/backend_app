

INSERT IGNORE INTO `users`(id,firstName,lastName,address,city,birthDate,gender,role,email,password,cv,company,modePaiment,début,fin)
VALUES
(1,'Admin','Admin','rue de liberté','nabeul','2000-5-15','Homme','admin','admin@gmail.com','$2y$10$N3HlUoQeJ/HAZ92DKu3DkeQuD3iYkaNduApo8.Y7ATQY2Rpxn/VHK',NULL,NULL,NULL,NULL,NULL),
(2,'Mohammed','Fehri','rue de santé','nabeul','2000-5-15','Homme','recruteur','mohammed.fehri@gmail.com','$2y$10$N3HlUoQeJ/HAZ92DKu3DkeQuD3iYkaNduApo8.Y7ATQY2Rpxn/VHK',NULL,NULL,NULL,NULL,NULL),
(3,'Yassin','Sahnoon','rue de bonneur','nabeul','2000-5-15','Homme','condidat','yassin.sahnoon@gmail.com','$2y$10$N3HlUoQeJ/HAZ92DKu3DkeQuD3iYkaNduApo8.Y7ATQY2Rpxn/VHK',NULL,NULL,NULL,NULL,NULL),
(4,'Baha','Maiza','rue fermé','nabeul','2000-5-15','Homme','condidat','baha.maiza@gmail.com','$2y$10$N3HlUoQeJ/HAZ92DKu3DkeQuD3iYkaNduApo8.Y7ATQY2Rpxn/VHK',NULL,NULL,NULL,NULL,NULL);

INSERT IGNORE INTO `categories`(id,nom) VALUES
(1,'Web developpement'),
(2,'Data siences'),
(3,'Aws cloud practitioner');

INSERT IGNORE INTO `tests`(id,categorie_id,name,description) VALUES
(1,1,'React js','Test sur react js'),
(2,1,'Vue js','Test sur vue js');

INSERT IGNORE INTO `quiz_questions`(id,content,test_id) VALUES
(1,'what is react js?',1),
(2,'How do you create a React app?',1),
(3,'What are the features of React?',1),
(4,'What is JSX?',1);

INSERT IGNORE INTO `quiz_answers`(id,content,valid,question_id,test_id) VALUES
(1,'React is a JavaScript library.',1,1,1),
(2,'React is a User Interface (UI) library.',1,1,1),
(3,'React is a tool for building UI controllers.',0,1,1),
(4,'Run create-react-app in terminal.',1,2,1),
(5,'Run npm build in terminal.',0,2,1),
(6,'Run npm start in terminal.',0,2,1),
(7,'One-way Data Binding.',1,3,1),
(8,'Low performence.',0,3,1),
(9,'JSX',1,3,1),
(10,'JSX allows us to write HTML elements in JavaScript and place them in the DOM with createElement() and/or appendChild() methods.',0,4,1),
(11,'JSX makes it easier to write and add HTML in React.',1,4,1),
(12,'JSX allows us to write HTML elements in JavaScript and place them in the DOM without any createElement()  and/or appendChild() methods.',1,4,1);
