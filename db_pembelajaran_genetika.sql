/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : db_pembelajaran_genetika

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 14/12/2024 00:57:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for game_answers
-- ----------------------------
DROP TABLE IF EXISTS `game_answers`;
CREATE TABLE `game_answers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `level` int NOT NULL,
  `answers` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `game_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of game_answers
-- ----------------------------
INSERT INTO `game_answers` VALUES (2, 1, 1, '{\"0_0\":\"BBKK\",\"0_1\":\"BBKK\",\"0_2\":\"BBKK\",\"0_3\":\"BBKK\"}', '2024-12-14 00:54:27', '2024-12-14 00:56:40');

-- ----------------------------
-- Table structure for game_correct_answers
-- ----------------------------
DROP TABLE IF EXISTS `game_correct_answers`;
CREATE TABLE `game_correct_answers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `level` int NOT NULL,
  `position` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `correct_answer` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `unique_position`(`level` ASC, `position` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of game_correct_answers
-- ----------------------------

-- ----------------------------
-- Table structure for materi
-- ----------------------------
DROP TABLE IF EXISTS `materi`;
CREATE TABLE `materi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `step` int NOT NULL DEFAULT 1,
  `urutan` int NOT NULL DEFAULT 1,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `gambar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of materi
-- ----------------------------
INSERT INTO `materi` VALUES (1, 'Pengenalan Pewarisan Sifat', 1, 1, 'Pewarisan sifat pada makhluk hidup dapat ditentukan oleh materi genetik yang terdiri dari kromosom, DNA, dan RNA. Selain itu, dapat ditentukan melalui sifat beda yaitu sifat dominan-resesif dan intermediet yang terdiri dari sifat fenotif dan genotif.\r\n\r\nPewarisan sifat dalam biologi adalah proses di mana sifat-sifat genetik dari induk diwariskan kepada keturunannya. Mekanisme pewarisan ini dipelajari melalui persilangan atau hibridisasi. Gregor Mendel, yang dikenal sebagai \"Bapak Genetika,\" melakukan eksperimen pada tanaman kacang ercis untuk menjelaskan pola pewarisan sifat.\r\n\r\nKonsep Dasar:\r\n- Gen: Unit pewarisan sifat yang terdapat dalam kromosom.\r\n- Aleel: Bentuk alternatif dari suatu gen (contoh: aleel untuk warna bunga merah dan putih).\r\n- Dominan: Sifat yang muncul jika ada setidaknya satu aleel dominan.\r\n- Resesif: Sifat yang hanya muncul jika kedua aleel bersifat resesif.', 'assets/images/materi/pengenalan.png', '2024-12-13 18:06:58', '2024-12-13 22:43:58');
INSERT INTO `materi` VALUES (2, 'Persilangan Monohibrid', 2, 1, 'Persilangan monohibrid adalah persilangan antara dua individu dengan satu sifat beda. Contohnya, persilangan antara tanaman berbunga merah dan tanaman berbunga putih.\r\n\r\nContoh: \r\n•	Tumbuhan berbunga kuning disilangkan dengan tumbuhan berbunga merah.\r\n•	Kucing berbulu putih dikawinkan dengan kucing berbulu hitam.\r\n•	Wanita berambut lurus menikah dengan laki-laki berambut keriting.\r\n\r\nTipe Persilangan:\r\n1. Dominan Penuh:\r\n- Aleel dominan sepenuhnya menutupi aleel resesif.\r\n- Contoh: Tanaman tinggi (TT) disilangkan dengan tanaman pendek (tt). Keturunan F1 semuanya tinggi (Tt).\r\n- Rasio fenotip F2: 3:1 (Tinggi: Pendek).\r\n\r\n2. Intermediat:\r\n- Tidak ada aleel yang dominan, sehingga sifat keturunan merupakan campuran.\r\n- Contoh: Bunga merah (MM) disilangkan dengan bunga putih (mm). Keturunan F1 adalah merah muda (Mm).\r\n- Rasio fenotip F2: 1:2:1 (Merah: Merah muda: Putih).', 'assets/images/materi/monohibrid.jpg', '2024-12-13 18:06:58', '2024-12-13 22:45:37');
INSERT INTO `materi` VALUES (3, 'Persilangan Dihibrid', 3, 1, 'Persilangan dihibrid melibatkan dua sifat beda. Contoh, tanaman mangga berbuah besar dan rasa asam disilangkan dengan mangga berbuah kecil dan rasa manis.\r\nPersilangan Dihibrid : Persilangan dengan dua sifat beda.\r\n\r\nPrinsip Utama:\r\n- Menggunakan hukum Mendel II (Asortasi Bebas), kombinasi aleel untuk dua sifat berbeda bersifat independen.\r\n\r\nContoh:\r\n- Parental: Besar, Asam (BBmm) × Kecil, Manis (bbMM).\r\n- F1: Semua keturunan besar dan manis (BbMm).\r\n- F2: Kombinasi sifat dengan rasio fenotip 9:3:3:1:\r\n  * 9 Besar, Manis\r\n  * 3 Besar, Asam\r\n  * 3 Kecil, Manis\r\n  * 1 Kecil, Asam\r\n\r\n- Sapi bertanduk pendek berambut putih dikawinkan dengan sapi bertanduk panjang \r\nberambut hitam. \r\n- Tumbuhan mangga berbuah besar, rasa masam disilangkan dengan mangga berbuah\r\nkecil, rasa manis. ', 'assets/images/materi/dihibrid.jpg', '2024-12-13 18:06:58', '2024-12-13 22:53:10');

-- ----------------------------
-- Table structure for minigame
-- ----------------------------
DROP TABLE IF EXISTS `minigame`;
CREATE TABLE `minigame`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `level` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `correct_answers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `correct_ratio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of minigame
-- ----------------------------
INSERT INTO `minigame` VALUES (1, 1, 'Persilangan Dihibrid Kacang Polong', 'Seorang petani memiliki dua jenis tanaman kacang polong. Kacang polong pertama memiliki biji bulat dan berwarna kuning (BBKK), sedangkan kacang polong kedua memiliki biji keriput dan berwarna hijau (bbkk). Sifat biji bulat (B) dominan terhadap biji keriput (b), dan warna kuning (K) dominan terhadap warna hijau (k).\r\n\r\nPetani tersebut menyilangkan kedua jenis kacang polong tersebut (F1), kemudian menyilangkan hasil keturunannya (F1 x F1).\r\n\r\nLengkapilah tabel Punnet untuk persilangan F1 x F1 berikut ini, kemudian tentukan rasio fenotipnya!', '{\r\n    \"0_0\":\"BBKK\", \"0_1\":\"BBKk\", \"0_2\":\"BbKK\", \"0_3\":\"BbKk\",\r\n    \"1_0\":\"BBKk\", \"1_1\":\"BBkk\", \"1_2\":\"BbKk\", \"1_3\":\"Bbkk\",\r\n    \"2_0\":\"BbKK\", \"2_1\":\"BbKk\", \"2_2\":\"bbKK\", \"2_3\":\"bbKk\",\r\n    \"3_0\":\"BbKk\", \"3_1\":\"Bbkk\", \"3_2\":\"bbKk\", \"3_3\":\"bbkk\"\r\n}', '[9,3,3,1]', '2024-12-13 23:59:04', '2024-12-14 00:54:19');

-- ----------------------------
-- Table structure for minigame_progress
-- ----------------------------
DROP TABLE IF EXISTS `minigame_progress`;
CREATE TABLE `minigame_progress`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `level` int NOT NULL DEFAULT 1,
  `skor` int NOT NULL DEFAULT 0,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'belum_selesai',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `minigame_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of minigame_progress
-- ----------------------------

-- ----------------------------
-- Table structure for nilai
-- ----------------------------
DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `jenis_tes` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nilai` int NOT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nilai
-- ----------------------------

-- ----------------------------
-- Table structure for progress_belajar
-- ----------------------------
DROP TABLE IF EXISTS `progress_belajar`;
CREATE TABLE `progress_belajar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `materi_selesai` int NOT NULL DEFAULT 0,
  `latihan_selesai` int NOT NULL DEFAULT 0,
  `minigame_level` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `progress_belajar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of progress_belajar
-- ----------------------------
INSERT INTO `progress_belajar` VALUES (1, 1, 3, 2, 0, '2024-12-12 23:31:37', '2024-12-13 23:48:49');
INSERT INTO `progress_belajar` VALUES (2, 2, 3, 0, 0, '2024-12-13 14:08:58', '2024-12-13 23:49:56');

-- ----------------------------
-- Table structure for soal
-- ----------------------------
DROP TABLE IF EXISTS `soal`;
CREATE TABLE `soal`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pertanyaan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `pilihan_a` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pilihan_b` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pilihan_c` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pilihan_d` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jawaban_benar` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT 'a',
  `penjelasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `gambar_penjelasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `kunci_jawaban` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `step` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of soal
-- ----------------------------
INSERT INTO `soal` VALUES (1, 'Pak Tri menyilangkan burung love bird berwarna kuning (KK) dengan burung lovebird berwarna hijau (kk). Sifat kuning dominan terhadap hijau. Apabila F1 disilangkan dengan sesamanya akan diperoleh F2 dengan perbandingan genotipe....', NULL, '9 : 3 : 3 : 1', '12 : 3 : 1', '1 : 2 : 1', '3 : 1', 'B', 'Mari saya bantu menjelaskan cara menyelesaikan soal genetika ini.\r\n\r\nJawaban: B. 12:3:1\r\n\r\nPenjelasan:\r\n\r\nDiketahui:\r\n- Burung love bird kuning (KK) >< burung love bird hijau (kk)\r\n- Sifat kuning dominan terhadap hijau\r\n- Ditanya perbandingan F2\r\n\r\nLangkah penyelesaian:\r\n\r\n1. Persilangan P1 (Parental):\r\n   KK (kuning) >< kk (hijau)\r\n   Semua keturunan F1 akan Kk (kuning)\r\n\r\n2. Persilangan F1 x F1:\r\n   Kk >< Kk\r\n   \r\n   Tabel Punnet:\r\n       K    k\r\n     +----+----+\r\n   K | KK | Kk |\r\n     +----+----+\r\n   k | Kk | kk |\r\n     +----+----+\r\n\r\n3. Hasil F2:\r\n   - KK (kuning) = 1\r\n   - Kk (kuning) = 2  \r\n   - kk (hijau) = 1\r\n\r\n4. Perbandingan fenotip F2:\r\n   Kuning : Hijau = (KK + Kk) : kk\r\n   = (1 + 2) : 1\r\n   = 3 : 1\r\n\r\n5. Perbandingan genotip F2:\r\n   KK : Kk : kk\r\n   1 : 2 : 1\r\n   Jika dikalikan 4 menjadi 12:3:1\r\n\r\nJadi, perbandingan genotip F2 adalah 12:3:1', NULL, 'c', 1);
INSERT INTO `soal` VALUES (2, 'Persilangan antara tanaman mawar merah (RR) dan tanaman mawar putih (rr) menghasilkan keturunan dengan fenotipe merah muda. Apabila F1 yang diperoleh disilangkan dengan sesamanya, perbandingan fenotipe F2 yang diperoleh adalah ....', NULL, '50% merah : 50% putih', '75% merah : 25% putih', '25% merah : 50% merah muda : 25% putih', '50% merah : 25% merah muda : 25% putih', 'C', 'Jawaban yang benar: C. 25% merah : 50% merah muda : 25% putih\r\n\r\nPenjelasan:\r\n\r\nDiketahui:\r\n   • Persilangan antara mawar merah (RR) dan mawar putih (rr)\r\n   • F1 yang dihasilkan berfenotipe merah muda  \r\n   • F1 disilangkan dengan sesamanya (F1 × F1)\r\n\r\nAnalisis:\r\n   • Mawar merah (RR) = homozigot dominan\r\n   • Mawar putih (rr) = homozigot resesif\r\n   • Persilangan pertama (P1):\r\n     RR × rr → Semua keturunan Rr (merah muda)\r\n\r\nPersilangan F1 × F1:\r\n   Rr × Rr\r\n   \r\n   Gamet:  R    r\r\n           R    r\r\n           \r\n   Hasil:\r\n   • RR = 1/4 (25%) = merah\r\n   • Rr = 2/4 (50%) = merah muda\r\n   • rr = 1/4 (25%) = putih\r\n\r\nKesimpulan:\r\n   • Perbandingan fenotipe F2: 25% merah : 50% merah muda : 25% putih\r\n   • Mengikuti hukum Mendel tentang segregasi alel\r\n   • Perbandingan fenotipe 1:2:1 untuk persilangan monohibrid dengan dominansi tidak sempurna\r\n\r\nPersilangan ini menunjukkan contoh pewarisan sifat dengan dominansi tidak sempurna (incomplete dominance), dimana fenotipe heterozigot (Rr) menunjukkan sifat intermediet (merah muda) antara kedua homozigotnya (merah dan putih).', NULL, 'c', 2);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kelas` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `materi_selesai` int NOT NULL DEFAULT 0,
  `latihan_selesai` int NOT NULL DEFAULT 0,
  `minigame_level` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Denis Akbar', 'bekoy', '$2y$10$H89zfcimS6R3xJmwZY9DJO.Nc419rEDx.Ek19xw97OJLtfPz3RYTe', '7', '2024-12-12 13:25:17', '2024-12-13 14:42:14', 3, 0, 1);
INSERT INTO `users` VALUES (2, 'Agus', 'agus', '$2y$10$Mr1Iyi3cgGJFMOlk8GgQk.WqtRH0JTl0qWitc7OijNAYfDRtgbiHy', '9', '2024-12-13 14:08:51', '2024-12-13 14:10:16', 3, 0, 1);

SET FOREIGN_KEY_CHECKS = 1;
