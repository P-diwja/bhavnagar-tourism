-- ============================================================
-- GoTrip Bhavnagar — FULL Database Setup
-- Run this entire file in phpMyAdmin > SQL tab
-- ============================================================

CREATE DATABASE IF NOT EXISTS gotrip_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gotrip_db;

-- ── ADMINS ───────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS admins (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  username   VARCHAR(60)  NOT NULL UNIQUE,
  password   VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
-- Default admin credentials: username=admin | password=admin123
-- After import, visit http://localhost/gotrip/reset_admin.php to change to gotrip@2024
-- The hash below is bcrypt of 'admin123' (cost=10), verified correct
DELETE FROM admins WHERE username='admin';
INSERT INTO admins (username, password) VALUES
  ('admin', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy');
-- Login with: admin / admin123  then run reset_admin.php to set your own password

-- ── PLACES ───────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS places (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  name     VARCHAR(150) NOT NULL,
  cat      VARCHAR(60),
  rating   DECIMAL(2,1),
  distance VARCHAR(30),
  open_hrs VARCHAR(100),
  lat      DECIMAL(11,8),
  lng      DECIMAL(11,8),
  entry    VARCHAR(80),
  tips     TEXT,
  img      TEXT,
  descr    TEXT,
  visible  TINYINT DEFAULT 1,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO places (name,cat,rating,distance,open_hrs,lat,lng,entry,tips,img,descr) VALUES
('Takhteshwar Temple','Spiritual',4.8,'1 km','6:00 AM – 9:00 PM',21.76599758,72.14574290,'Free','Visit at sunrise or sunset for panoramic Gulf views.','https://dynamic-media-cdn.tripadvisor.com/media/photo-o/08/07/fa/fe/caption.jpg?w=2000&h=-1&s=1','Built in 1893 by Maharaja Takhatsinghji, this marble hilltop Shiva temple commands 360° views of Bhavnagar city and the Gulf of Khambhat.'),
('Gaurishankar Lake','Nature',4.5,'3 km','Open All Day',21.75526235,72.12051824,'Rs.10','Musical fountain runs evenings. Birdwatchers should arrive at dawn.','https://i0.wp.com/www.jovialholiday.com/wp-content/uploads/2024/11/gaurishankar-lake-bhavnagar.jpg?w=1080&ssl=1','Historic Bor Talav reservoir built in 1872. Recreational hub with boat rides, musical fountain, planetarium and 200+ bird species.'),
('Barton Museum','History',4.6,'1 km','9 AM – 1 PM, 2 PM – 6 PM (Closed Sun)',21.77210300,72.15354704,'Rs.5','Entry just Rs.5. Closed Sundays and 2nd/4th Saturday.','https://hblimg.mmtcdn.com/content/hubble/img/ttd_images/mmt/activities/m_Bhavnagar_Barton_library_1_l_349_639.jpg','1895 Victorian-era museum with royal artefacts and folk arts of the Gohil dynasty. Features rare Mahatma Gandhi photographs and personal artefacts from his years in Bhavnagar.'),
('Nilambag Palace','Heritage',4.7,'2 km','Restaurant 7:30 AM – 10 PM',21.76741101,72.13077744,'Hotel guests / Cafe visitors','Non-guests can visit the garden, cafe and restaurant without a room booking.','https://www.nilambagpalace.com/img/restaurant/heritage-1.jpg','Grand 19th-century Gohil dynasty residence — now a heritage hotel with peacocks in lush gardens. Mahatma Gandhi was a frequent guest here.'),
('Victoria Park','Nature',4.3,'3 km','6 AM – 9 AM & 4 PM – 7 PM',21.75239106,72.12807535,'Free','Early morning 6 to 8 AM is best for birdwatching and wildlife spotting.','https://dynamic-media-cdn.tripadvisor.com/media/photo-o/12/6a/c4/2e/img-20180314-074349-largejpg.jpg?w=1200&h=-1&s=1','500-acre protected tropical forest established 1888. Home to nilgai, foxes, porcupines, jackals and 200+ bird species with walking trails.'),
('Nishkalank Mahadev','Spiritual',4.9,'24 km','Tide-dependent (~10 AM – 2 PM)',21.59762811,72.29256108,'Free','Check tide timings before visiting. Grand festival on Maha Shivratri.','https://hblimg.mmtcdn.com/content/hubble/img/ttd_images/mmt/activities/m_Bhavnagar_Nishkalank_mahadev_temple_1_l_360_640.jpg','Extraordinary sea temple 1 km into the Arabian Sea. Submerges at high tide. At low tide devotees walk barefoot to worship 5 Shivalingas placed here by the Pandavas.'),
('Alang Ship Yard','Industrial',4.3,'37 km','Restricted Access',21.46333923,72.29680848,'Permission required','Visit the road-side ship furniture market on the Alang highway — open freely.','https://akm-img-a-in.tosshub.com/indiatoday/images/story/201406/alang_650_062814030008.jpg','World largest ship recycling yard stretching 10 km along Gulf of Khambhat. Over 20,000 workers dismantle supertankers and warships.'),
('Ghogha Beach','Beach',4.4,'17 km','Open All Day',21.67673560,72.28455468,'Free','Safe for swimming at low tide. Visit Ghogha historic mosque nearby.','https://bmcgujarat.com/media/sbtpzebg/bhavnagar_mahuva_beach_006.jpg','Golden-sand beach in ancient port town of Ghogha. Marco Polo visited this port in the 13th century. Known for sunrise views and a relaxed family atmosphere.'),
('BAPS Swaminarayan Mandir','Spiritual',4.7,'2 km','6 AM – 12 PM and 4 PM – 8 PM',21.75402374,72.14201566,'Free','Dress modestly — no shorts. Prasad available after morning prayers.','https://www.baps.org//Data/Sites/1/Media/LocationImages/131131-bhavnagar.jpg','Stunning BAPS Aksharwadi Temple with intricate marble carvings and a peaceful campus. One of Bhavnagar most architecturally impressive religious sites.'),
('Piram Bet Island','Adventure',4.5,'29 km by boat','Daytime boat dependent',21.59566756,72.36076985,'Rs.200 boat','Book the lighthouse boat at Bhavnagar port. Take food and water — no facilities on island.','https://hblimg.mmtcdn.com/content/hubble/img/ttd_images/mmt/activities/m_Bhavnagar_Gopnath_beach_1_l_504_640.jpg','Remote Gulf island with a historic lighthouse, ancient fossils including dinosaur eggs, and a Shiva temple. An off-the-beaten-path adventure by boat.'),
('Crescent Circle Market','Culture',4.2,'1 km','9 AM – 9 PM',21.77304302,72.15340461,'Free','Shop for Bhavnagri Gathiya and handmade silver jewellery. Bargaining is expected.','https://berqwp-cdn.sfo3.cdn.digitaloceanspaces.com/cache/bhavnagar.city/wp-content/uploads/2024/07/crescent-tower-2-edited-jpg.webp?bwp','The vibrant old city market at Bhavnagar historic centre. Famous for Bhavnagri Gathiya snack shops, silver and gold jewellery, hand-embroidered fabrics.'),
('Bhavnagar Science Centre','Culture',4.2,'8 km','10 AM – 7 PM (Closed Mon)',21.78369417,72.07801096,'Rs.50 general','Opened in 2022. Has VR simulators, animatronic dinosaurs, Marine Aquatic gallery.','https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/14/d9/9a/nice-place-to-visit.jpg?w=1200&h=-1&s=1','Regional science centre with interactive exhibits on astronomy, physics and biology. Houses a working planetarium and a dedicated children science gallery.'),
('Bhav Vilas Palace','Heritage',4.4,'4 km','Exterior view only',21.75575062,72.11764113,'Free','The iron gate was cast in Dublin, Ireland — look closely at its craftsmanship.','https://lh3.googleusercontent.com/gps-cs-s/AHVAwerbvi-c5bZZGBHuHtMQx9Mo9ZKuoZNX2KKP1cEzQqvaPszy9KoFYeLyqHsorFqNj1MEsn_IhJzlLT4C99JW-m5Grcr6EUIV1eUQdHNiTkQ6016HNxw6qeV5G-vqb_Mmb3dPw2xW=s1360-w1360-h1020-rw','Built in 1893 by Maharaja Takhtsinghji facing Gaurishankar Lake. Designed by Sir John Griffiths in traditional Hindu style, its Dublin-cast iron gates are a marvel.'),
('Sardar Baug','Heritage',4.2,'1 km','8 AM – 6 PM',21.77201778,72.14137454,'Rs.10','The garden is especially beautiful in the morning light.','https://itin-dev.wanderlogstatic.com/freeImage/wF79eCZH3BDk565DY3uilbpXzKt70xMn','A beautifully landscaped royal garden in the heart of Bhavnagar featuring a historic Gohil dynasty palace. With well-maintained lawns, colourful flower beds, fountains and shaded walkways.'),
('Ganga Deri','Heritage',4.3,'2 km','8 AM – 8 PM',21.77601047,72.14422297,'Free','The marble work is best appreciated up close at midday.','https://static.wixstatic.com/media/1787fd_7db1b727e8694bd79ecd3f3fa9e159ab~mv2.jpg/v1/fill/w_1002,h_928,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/IMG_20210414_0806201.jpg','A stunning all-marble memorial built in the style of the Taj Mahal on the banks of Gangajalia Lake. Built by the Gohil royal family.'),
('Malnath Mahadev Temple','Spiritual & Nature',4.5,'19 km','6 AM – 8 PM',21.60416168,72.10241740,'Free','Combine with Trambak Waterfall nearby — both are within walking distance. Monsoon season is magical here.','https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhncrOU3NtAuFtHP0Prs2mv4gQ5mjZmSmuBdN9Y-JbB03j-uOUfTHwOXQKOTAngjXo7GiMNpU0maW6irhacuDUFV1aiatoTHgzqfvQCL3IwcvJ3EcBtFXseIvwlLw7YzWA2KKETwFHKEh5y/s1600/3972158390_3959d128ac_z.jpg','Ancient Shiva temple nestled at the base of forested hills, 19 km from Bhavnagar. The temple sits beside the Trambak Waterfall stream.'),
('Nath Hills','Nature',4.5,'18 km','Open All Day',21.60522838,72.10956228,'Free (resort charges apply)','Visit at sunset for the most dramatic windmill and valley views.','https://www.nathhills.com/images/optim.jpg','A stunning hilltop retreat at Bhadi village on the Malnath Hills along NH-51. The hills are dotted with giant windmills that create a dramatic skyline.');

-- ── NEARBY DESTINATIONS ─────────────────────────────────────
CREATE TABLE IF NOT EXISTS nearby (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(150) NOT NULL,
  cat        VARCHAR(60),
  distance   VARCHAR(30),
  best       VARCHAR(40),
  lat        DECIMAL(11,8),
  lng        DECIMAL(11,8),
  entry      VARCHAR(80),
  tips       TEXT,
  img        TEXT,
  descr      TEXT,
  highlights TEXT,
  visible    TINYINT DEFAULT 1,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO nearby (name,cat,distance,best,lat,lng,entry,tips,img,descr,highlights) VALUES
('Palitana','Spiritual','42 km','Oct–Mar',21.53398665,71.82775500,'Free','Start climbing by 6 AM to avoid the afternoon heat.','https://bmcgujarat.com/media/y5ifnm3f/1__rx-bf1wofzi7-sgqds3ca.png','World only city to legally ban meat. 900+ marble Jain temples on Shatrunjaya Hill — 3,500 steps with stunning Gulf views.','900+ Jain Temples,3500 Steps,Shatrunjaya Hill'),
('Velavadar NP','Wildlife','34 km','Dec–Mar',22.04396610,72.02046098,'Rs.20 + vehicle fee','Safaris run 6:30–9:30 AM and 3:30–6:30 PM.','https://bmcgujarat.com/media/3phfsxhl/2-blackbucks-can-achive-speeds-of-upto-80-kmph-when-leaping-1.jpg','India finest grassland sanctuary with 3,000+ blackbuck — the densest population on Earth.','3000+ Blackbuck,Lesser Florican,Grassland Safari'),
('Diu','Beach Heritage','168 km','Nov–Mar',20.71925606,70.98581819,'Free','Stay overnight — Diu is completely different after sundown.','https://s7ap1.scene7.com/is/image/incredibleindia/2-ghoghla-beach-diu-daman-and-diu-city-ff?qlt=82&ts=1726737882980','Former Portuguese colony with stunning beaches, a 16th-century sea fort and whitewashed churches.','16th Century Fort,Nagoa Beach,Portuguese Churches'),
('Sarangpur','Spiritual','59 km','Year Round',22.15754840,71.77131341,'Free','Visit on a Tuesday for the massive weekly pilgrimage gathering.','https://www.templepurohit.com/wp-content/uploads/2016/04/Hanuman-temple-Salangpur.jpg','Home to Kashtabhanjan Hanumanji Temple and a magnificent BAPS marble complex. Draws 50,000+ pilgrims every Tuesday.','Kashtabhanjan Hanuman,BAPS Marble Temple,50K+ Tuesday Pilgrims'),
('Lothal','History','80 km','Oct–Mar',22.01840884,72.25173100,'Rs.25','Hire the ASI guide at the entrance — the context transforms the site completely.','https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/LothalDockyard.jpg/1200px-LothalDockyard.jpg','4,500-year-old Indus Valley Civilisation port city — one of the most important archaeological sites in the world.','4500-Year-Old Ruins,Indus Valley,Ancient Dockyard'),
('Gopnath Beach','Beach','35 km','Oct–Mar',21.46000000,72.22000000,'Free','Best visited at sunset or for overnight camping.','https://hblimg.mmtcdn.com/content/hubble/img/ttd_images/mmt/activities/m_Bhavnagar_Gopnath_beach_1_l_504_640.jpg','Secluded beach with the ancient Gopnath Mahadev temple perched on rocks above the sea. One of Saurashtra most beautiful and remote beaches.','Secluded Beach,Ancient Temple,Camping,Stargazing'),
('Gir National Park','Wildlife','174 km','Dec–May',21.16884116,70.59854978,'~Rs.5500–7000 per jeep','Book online at girlion.gujarat.gov.in at least 2–3 months in advance.','https://lh3.googleusercontent.com/gps-cs-s/AHVAweor2vUJuat8c-cafkB37Y3IYdTN1S8qwIM_F69AI1gtpUJe85d9k2rq6eG_1sYY2ukUE6Z9DgK6-3gUdeCh_ebN4FWKb2nHOVVNWOCpUHwsy4I9ISu-tc1uVRae50DpxZEvcpXAxw=s1360-w1360-h1020-rw','The only home of the Asiatic Lion in the world. Gir National Park protects over 600 lions in 1,400 sq km of dry deciduous forest.','Asiatic Lions,Leopards,Jungle Safaris,Over 600 Lions'),
('Junagadh','Heritage','177 km','Oct–Mar',21.52417878,70.45941089,'Rs.50','Climb Girnar Hill (10,000 steps) for stunning views.','https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Bahauddin_Maqbara_by_Kshitij.jpg/960px-Bahauddin_Maqbara_by_Kshitij.jpg','Ancient city at the foot of Mount Girnar, one of Gujarat most sacred hills. Features Buddhist caves dating to 250 BCE, Ashoka rock edicts.','Girnar Hill,Ashoka Edicts,Buddhist Caves,Mahabat Maqbara'),
('Dwarka','Spiritual','333 km','Oct–Mar',22.24413322,68.96823489,'Free','Visit the Dwarkadhish Temple at sunrise — the golden light on the temple spire is spectacular.','https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Dwarakadheesh_Temple%2C_2014.jpg/960px-Dwarakadheesh_Temple%2C_2014.jpg','One of the four sacred dhams of Hinduism and the ancient kingdom of Lord Krishna. The 2,500-year-old Dwarkadhish Temple rises on the banks of the Gomti River.','Dwarkadhish Temple,Bet Dwarka Island,Gomti Ghat');

-- ── FOODS ────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS foods (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(150) NOT NULL,
  food_type  VARCHAR(20),
  cat        VARCHAR(50),
  rating     DECIMAL(2,1),
  budget     VARCHAR(40),
  specialty  VARCHAR(150),
  area       VARCHAR(100),
  lat        DECIMAL(11,8),
  lng        DECIMAL(11,8),
  phone      VARCHAR(30),
  open_hrs   VARCHAR(100),
  descr      TEXT,
  tips       TEXT,
  must_try   TEXT,
  section    VARCHAR(20) DEFAULT 'city',
  visible    TINYINT DEFAULT 1,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO foods (name,food_type,cat,rating,budget,specialty,area,lat,lng,phone,open_hrs,descr,tips,must_try) VALUES
('Lachhubhai Ganthiyawala','Veg','Street Food',4.6,'Rs.20–80','Pav Gathiya, Bhavnagri Gathiya','Ghogha Circle',21.7624,72.1516,'','7 AM – 10 PM','Since 1951 — a true Bhavnagar icon. Ghogha Circles most famous Pav Gathiya stall with over 70 years of legacy.','The Pav Gathiya here is what every local recommends first to any visitor.','Pav Gathiya,Bhavnagri Gathiya,Nylon Gathiya'),
('Narsidas Bavabhai Gathiyawala','Veg','Street Food',4.7,'Rs.20–100','Bhavnagri Gathiya, Lasaniya Gathiya','Khargate',21.7618,72.1490,'093771 00049','8 AM – 8 PM','Established in 1920 — the oldest gathiya institution in Bhavnagar. Jawaharlal Nehru once ate here.','One of the most historically significant snack shops in Saurashtra. Try the double mari vanela gathiya.','Bhavnagri Gathiya,Lasaniya Gathiya,Methi Gathiya,Champakali'),
('Jay Somnath Dal Puri','Veg','Street Food',4.5,'Rs.40–80','Dal Puri, Aloo Curry','Khargate',21.7618,72.1508,'','6 AM – 12 PM','A beloved breakfast institution in Bhavnagar historic Khargate area. Hot fluffy puris with thick secret-spiced dal.','Go before 9 AM — the dal runs out. Cash only.','Dal Puri,Aloo Curry,Shrikhand Puri'),
('Bapa Sitaram Nasta Gruh','Veg','Street Food',4.4,'Rs.30–80','Dal Puri, Farsan','Kalanala',21.7630,72.1500,'','7 AM – 12 PM','A trusted morning institution in the Kalanala area. Popular for dal puri, fresh farsan and quick Gujarati breakfast items.','Arrives early — opens at 7 AM and closes when food runs out.','Dal Puri,Fafda,Khaman,Sev Usal'),
('Pahadi Momos','Veg','Street Food',4.6,'Rs.40–100','Steamed & Fried Momos','Takhteshwar Hill',21.7638,72.1548,'','3 PM – 10 PM','A tiny wildly popular momo stall at the base of Takhteshwar hill. The steamed momos with house-made red garlic chutney are extraordinary.','Fried momos with schezwan chutney are the crowd favourite. Only open evenings.','Steamed Momos,Fried Momos,Garlic Red Chutney'),
('Balaji Ice Dish Gola','Veg','Street Food',4.3,'Rs.20–60','Ice Gola, Kala Khatta','Ghogha Circle',21.7622,72.1514,'','11 AM – 10 PM','A beloved shaved ice stall at Ghogha Circle. Colourful ice golas drenched in flavoured syrups — a summer staple.','Kala Khatta and Kesar are the most popular flavours. Best on a hot afternoon.','Kala Khatta Gola,Kesar Gola,Mixed Fruit Gola'),
('Shree Ram Farsan','Veg','Street Food',4.3,'Rs.30–100','Bhavnagri Gathiya, Bhajiya','Ghogha Circle',21.7630,72.1530,'','8 AM – 9 PM','Since 1962 — one of Bhavnagars most loved farsan shops with 40+ varieties. Famous for soft Bhavnagri Gathiya.','Vacuum-packed Bhavnagri Gathiya makes the best souvenir from Bhavnagar.','Bhavnagri Gathiya,Bhajiya,Chakri,Mohanthal'),
('Nilambag Palace Dining','Veg','Restaurant',4.8,'Rs.400–900','Royal Gujarati Thali','Nilambag Palace',21.7574,72.1540,'+912782424241','7:30 AM – 10:30 PM','Dine like royalty in the 19th-century palace dining hall. An 18-dish Royal Thali with sev tameta, methi dhokla.','Book the garden dinner in advance for a heritage experience under the stars.','Royal Gujarati Thali,Shrikhand Puri,Mohanthal,Sev Tameta'),
('Rasoi Dining Hall','Veg','Restaurant',4.5,'Rs.120–250','Gujarati Thali, Dal Dhokli','Kalanala',21.7628,72.1505,'02782522535','11 AM – 3:30 PM and 6:30 – 10:30 PM','One of Bhavnagars most consistently praised dining halls for authentic Gujarati thali.','Lunch thali is the best value — arrive by 12:30 PM on weekdays.','Gujarati Thali,Dal Dhokli,Kadhi Khichdi,Chaas'),
('Jalaram Paratha House','Veg','Restaurant',4.4,'Rs.80–180','Butter Paratha, Sev Tameta','Kalanala',21.7625,72.1498,'','7 AM – 3 PM and 6:30 – 10:30 PM','A cherished local restaurant on Kalanala Road known for its buttery parathas and authentic Kathiyawadi sev tameta.','Sev Tameta with butter paratha is a combo locals swear by.','Butter Paratha,Sev Tameta,Masala Chai'),
('The Chocolate Room','Veg','Cafe',4.1,'Rs.150–350','Chocolate Desserts, Shakes','Waghawadi Road',21.7560,72.1630,'','11 AM – 10:30 PM','Bhavnagars favourite dessert cafe near Valentine Circle. Famous for an indulgent range of chocolate desserts.','The hot sizzling brownie with ice cream is the signature must-try.','Sizzling Brownie,Hot Chocolate,Waffles,Chocolate Shake'),
('Coffee Culture','Veg','Cafe',4.2,'Rs.120–300','Coffee, Pizza, Sizzlers','Hill Drive / Waghawadi',21.7558,72.1628,'','10 AM – 11 PM','Bhavnagars most popular Italian-style coffee cafe with a social, modern atmosphere. Known for Rainbow Coffee.','Try the Rainbow Coffee — it is their signature.','Rainbow Coffee,Cappuccino Latte,Farmhouse Pizza,Veg Sizzler'),
('Mehta Sweets','Veg','Sweets',4.3,'Rs.40–200','Ghari, Peda, Mithai','Kalanala Market',21.7631,72.1495,'','8 AM – 9 PM','A popular local sweet shop in Kalanala Market known for traditional Gujarati mithai.','Ghari is a Bhavnagar-style rich sweet — try the fresh batch in the morning.','Ghari,Peda,Mohanthal,Ladoo'),
('Gwalia Sweets & Fast Food','Veg','Sweets',4.4,'Rs.50–300','Mithai, Ice Cream, Farsan','ISCON Mega City',21.7552,72.1628,'','9 AM – 10:30 PM','A well-known Gujarat sweet chain at ISCON Mega City. Massive range of traditional Indian sweets.','Pre-order hampers 2–4 days in advance for festivals.','Kaju Katli,Kesar Katli,Gulab Jamun,Dahi Chaat'),
('Hotel Yadgar','Non-Veg','Non-Veg',4.2,'Rs.150–350','Chicken Biryani, Mughlai','Near Railway Station',21.7643,72.1449,'','11 AM – 11 PM','One of Bhavnagars most recommended non-vegetarian restaurants near the Railway Station.','Chicken Biryani is the crowd favourite. Arrive by 1 PM for lunch.','Chicken Biryani,Mughlai Chicken,Seekh Kebab'),
('Dilip Pav Gathiya','Veg','Fast Food',4.5,'Rs.20–50','Pav Gathiya','Waghawadi Road (Vishwakarma Circle)',21.7560,72.1600,'','7 AM – 2 PM','Since 1969 — a legendary institution near Vishwakarma Circle. Famous for using special small-sized pavs with a unique tamarind chutney.','Visit before 10 AM for the freshest batch. Cash only.','Pav Gathiya,Chana Math,Masala Chai'),
('Pappubhai Chaat','Veg','Fast Food',4.4,'Rs.30–80','Pani Puri, Dahi Puri','Near Kalanala',21.7632,72.1498,'','11 AM – 9 PM','Bhavnagars most famous chaat stall near Kalanala area. The pani puri is crisp, the pani is perfectly spiced.','Go in the evening when the chaat is freshest.','Pani Puri,Dahi Puri,Sev Puri'),
('Jay Khodiyar Sandwich','Veg','Hidden Gem',4.3,'Rs.40–100','Loaded Sandwich','Kalanala / College Area',21.7630,72.1490,'','9 AM – 10 PM','A beloved sandwich stall near the college area loaded with vegetables, cheese, spicy chutneys.','Ask for extra green chutney — it is what makes their sandwich unique.','Loaded Veg Sandwich,Cheese Sandwich,Masala Toast'),
('Aslam Frankie','Veg','Hidden Gem',4.2,'Rs.40–80','Frankie Rolls','Near Gulista / City Centre',21.7635,72.1520,'','11 AM – 10 PM','A popular frankie stall near Gulista known for its spicy, tightly-wrapped rolls.','The paneer frankie is the most popular. Add extra schezwan sauce.','Paneer Frankie,Aloo Frankie,Veg Roll'),
('Zam Zam Restaurant','Non-Veg','Non-Veg',4.1,'Rs.150–400','Mughlai, Biryani','Kalanala Area',21.7628,72.1488,'','11 AM – 11 PM','A well-known Mughlai restaurant in the Kalanala area serving fragrant biryanis, kebabs and curry dishes.','The Chicken Dum Biryani is their signature dish — rich and aromatic.','Chicken Dum Biryani,Seekh Kebab,Mutton Curry,Roomali Roti');

-- ── HOTELS ───────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS hotels (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(150) NOT NULL,
  tier       VARCHAR(20),
  price      VARCHAR(30),
  rating     DECIMAL(2,1),
  area       VARCHAR(100),
  descr      TEXT,
  hotel_type VARCHAR(30),
  amenities  TEXT,
  visible    TINYINT DEFAULT 1,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO hotels (name,tier,price,rating,area,descr,hotel_type,amenities) VALUES
('Jain Dharamshala','ultra','₹100–300',0.0,'Near Old City / Temples','Community-run Jain dharamshalas near the old city temples. Basic clean rooms with shared bathrooms.','Dharamshala','Basic rooms,Shared bathroom,Spiritual environment'),
('Swaminarayan Dharamshala','ultra','₹100–300',0.0,'Near BAPS Temple','Accommodation run by the Swaminarayan Sanstha near the temple complex.','Dharamshala','Basic rooms,Clean,Spiritual setting'),
('Hotel Mini','budget','₹600–1,200',3.8,'City Centre','A compact no-frills budget hotel in the city centre. Clean basic rooms, convenient location.','Hotel','AC rooms,City centre location,24hr reception'),
('Hotel Jubilee','budget','₹1,200–2,000',3.6,'Crescent Circle','Located near Crescent Circle market area, one of Bhavnagars oldest hotels.','Hotel','AC rooms,Near market,Free WiFi,24hr reception'),
('Hotel Relax Inn','budget','₹800–1,500',3.9,'Near Railway Station','A budget hotel conveniently located 1 km from Bhavnagar Railway Station.','Hotel','Free WiFi,Near railway,AC rooms,Parking'),
('Hotel Sun N Shine','comfort','₹1,800–2,500',3.8,'Waghawadi Road','A reliable mid-budget hotel on Waghawadi Road housing the popular RGB Restaurant.','Hotel','Restaurant,Free WiFi,AC rooms,Parking,City location'),
('Hotel White Rose','comfort','₹1,200–2,000',4.0,'Near Bus Stand / Victoria','A clean and peaceful budget hotel near the bus stand, railway station and airport.','Hotel','Near bus stand,AC rooms,Free WiFi,Airport accessible'),
('Hotel The Sankalp Retreat','comfort','₹1,400–2,500',4.3,'Main City','One of Bhavnagars most highly reviewed budget-comfort hotels. Closest hotel to the city centre at 2.1 km.','Hotel','Restaurant,Free WiFi,AC rooms,Parking,24hr service'),
('Hotel Virgo Sumeru','midrange','₹2,800–4,500',4.1,'Waghawadi Road','A well-appointed 3-star hotel on Waghawadi Road. Modern rooms, business-class amenities.','Hotel','Restaurant,Free WiFi,AC rooms,Parking,Business centre,Room service'),
('Hotel Clarks Collection','midrange','₹2,500–3,500',4.8,'City Centre','TripAdvisors top-rated hotel in Bhavnagar with a 4.8 rating. Clean rooms, excellent staff behaviour.','Hotel','Restaurant,Free WiFi,AC rooms,Parking,Fitness centre'),
('Narayani Heritage','midrange','₹2,500–4,000',4.3,'City Area','A heritage-themed mid-range property with traditional design elements. Popular with families.','Hotel','Restaurant,Free WiFi,AC rooms,Heritage décor,Parking'),
('The Basil Park','midrange','₹3,000–4,500',4.1,'ISCON / Victoria Park','A modern hotel opposite Victoria Park near ISCON Mega City.','Hotel','Restaurant,Free WiFi,AC rooms,Parking,Modern amenities'),
('Top3 Lords Resort','midrange','₹2,600–3,500',4.7,'Near Airport / Outskirts','Bhavnagars highest-rated resort property (4.7 on TripAdvisor). Excellent rooms, spa, pool and restaurant.','Resort','Pool,Spa,Restaurant,Free WiFi,Parking,Garden,Fitness centre'),
('Efcee Sarovar Premiere','premium','₹4,500–7,000',4.5,'Near Victoria Park','A premium 4-star hotel opposite Victoria Park near ISCON Mega City. Excellent rooms, multiple dining options.','Hotel','Pool,Spa,Restaurant,Free WiFi,Parking,Gym,24hr room service,Bar'),
('Iscon The Fern Resort & Spa','premium','₹2,800–4,500',4.5,'Opposite Victoria Forest','A premium resort-style property opposite Victoria Forest. Beautiful green surroundings.','Resort','Pool,Spa,Restaurant,Free WiFi,Parking,Garden,Gym'),
('Nilambag Palace Hotel','luxury','₹4,000–6,500',4.5,'Nilambaug Circle','Bhavnagars only heritage palace hotel — a living piece of royal history. Once the residence of the Gohil royal family.','Heritage','Restaurant,Free WiFi,Pool,Tennis,Garden,Heritage tours,Parking,Pet-friendly'),
('The Blackbuck Trails Velavadar','luxury','₹8,000–12,000',4.6,'Velavadar (~42 km)','A premium wildlife lodge adjacent to Velavadar National Park — perfect for visitors doing blackbuck safaris.','Wildlife Lodge','Pool,Restaurant,Safari packages,Free WiFi,Nature walks,Bonfire');

-- ── EVENTS ───────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS events (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(200) NOT NULL,
  event_date VARCHAR(60),
  event_time VARCHAR(50),
  loc        VARCHAR(150),
  event_type VARCHAR(30),
  seasonal   TINYINT DEFAULT 1,
  descr      TEXT,
  visible    TINYINT DEFAULT 1,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO events (name,event_date,event_time,loc,event_type,seasonal,descr) VALUES
('Palitana Shatrunjaya Pilgrimage Season','Oct–Mar (Peak Season)','Dawn onwards','Palitana Hills (60 km)','Spiritual',1,'The 3,800+ step climb to the 900 Jain temples atop Shatrunjaya Hill. Considered the holiest pilgrimage in Jainism.'),
('Velavadar Blackbuck Safari Season','Oct – Mar','6–8 AM / 4–6 PM','Velavadar NP (42 km)','Nature',1,'Best season to spot blackbucks, wolves, hyenas and migratory birds at Velavadar National Park.'),
('Maha Shivratri — Nishkalank Mahadev','Annual (Feb/Mar)','4 AM – midnight','Nishkalank Mahadev, Koliyak','Spiritual',1,'The most sacred night at Nishkalank Mahadev — a Shiva temple that appears only at low tide in the sea.'),
('Janmashtami at BAPS Swaminarayan Mandir','Annual (Aug)','6 PM – midnight','BAPS Mandir, Bhavnagar','Spiritual',1,'One of Bhavnagars biggest celebrations. The BAPS Swaminarayan temple transforms with lights and devotional music.'),
('Navratri Garba — City Grounds','Annual (Sep/Oct)','9 PM – 2 AM','City Grounds / Victoria Park area','Cultural',1,'Nine nights of garba and dandiya raas across Bhavnagar. Victoria Park area and city grounds host the biggest gatherings.'),
('Shamlaji Tribal Fair (Shamlaji Melo)','Annual (Nov, Kartik Purnima)','All day','Shamlaji Temple (~120 km)','Cultural',1,'One of Gujarats most important tribal fairs held over 3 weeks near Shamlaji Temple. Thousands arrive on foot and camel carts.'),
('Uttarayan — Kite Festival','Jan 14 every year','All day','Across Bhavnagar city','Cultural',1,'Bhavnagars skies fill with thousands of kites on Makar Sankranti. Rooftop kite battles, street food stalls all day.'),
('Monsoon Waterfall Trek — Shetrunji Dam','Jul – Sep','6 AM – 2 PM','Shetrunji Dam / Palitana foothills','Adventure',1,'Post-monsoon waterfalls appear around the Shetrunji river and Palitana foothills during July–September.'),
('Gopnath Beach Camping Season','Oct – Feb','Overnight','Gopnath Beach (35 km)','Adventure',1,'The secluded Gopnath Beach near the historic Gopnath Mahadev temple becomes a camping spot for groups.'),
('Piram Island Boat Trip Season','Nov – Mar (best tides)','7 AM – 1 PM','Ghogha Jetty → Piram Island','Offbeat',1,'The best season to visit Piram Bet island by boat from Ghogha jetty. Ancient Shiva temple, undisturbed beaches and dolphin sightings.'),
('Alang Ship Yard Industrial Tour','Year-round (weekdays)','9 AM – 2 PM','Alang Ship Breaking Yard (50 km)','Offbeat',0,'The worlds largest ship-recycling yard — a surreal landscape of beached vessels being dismantled by hand.'),
('Ganga Deri Evening Aarti','Every Friday 7 PM','7:00 – 8:00 PM','Ganga Deri Cenotaph, Old City','Spiritual',0,'A serene weekly aarti at the royal cenotaphs of Ganga Deri in the old city. Oil lamps, devotional music.'),
('Saturday Antique Bazaar','Every Saturday','8 AM – 1 PM','Crescent Circle Market area','Cultural',0,'A weekly market near Crescent Circle where vendors sell old coins, antique brass items, vintage jewellery.'),
('Takhteshwar Hill Sunrise Walk','Every Sunday 5:30 AM','5:30 – 7:00 AM','Takhteshwar Temple, Hill top','Wellness',0,'A local tradition — Sunday morning walkers climb Takhteshwar Hill to catch the sunrise over the Gulf of Khambhat.');

-- ── REVIEWS (update existing or create fresh) ────────────────
CREATE TABLE IF NOT EXISTS reviews (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100) NOT NULL,
  rating     TINYINT NOT NULL,
  message    TEXT NOT NULL,
  image_path VARCHAR(300) NULL DEFAULT NULL,
  approved   TINYINT DEFAULT 0,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
-- If you already ran setup.sql before, run this to add the approved column:
-- ALTER TABLE reviews ADD COLUMN IF NOT EXISTS approved TINYINT DEFAULT 1;

INSERT INTO reviews (name, rating, message, image_path, approved) VALUES
('Rahul Sharma', 5, 'Bhavnagar is absolutely stunning! Takhteshwar temple at sunset is pure magic. The city is clean, people are warm, and the food is incredible. Will definitely visit again!', NULL, 1),
('Priya Patel',  4, 'Loved the Bhavnagari Gathiya breakfast trail near Ghogha Circle. The Nilambag Palace is a hidden gem. GoTrip helped me plan everything perfectly — highly recommended!', NULL, 1),
('Amit Desai',   5, 'Victoria Park birdwatching was a highlight. Spent three days exploring with the AI Planner and it was spot on. Gaurishankar Lake at evening is breathtaking.', NULL, 1);
