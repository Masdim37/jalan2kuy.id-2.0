-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2026 pada 21.48
-- Versi server: 8.0.43
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jalan2kuy_id`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`adminID`, `name`, `username`, `password`, `email`, `gender`) VALUES
('adm001', 'Admin_Dhimas', 'Dhimas', '$2y$12$fjbV4FwGELrPCbHzMXAVve/JVDXsdKxfOAJ.2C9Ywt05j3EYq6K8C', 'dhimas@gmail.com', 1),
('adm002', 'Admin_Joshua', 'Joshua', '$2y$12$.hImNWuOLeBGXVdZkwzcgeB1Zct/FPLdMl9oKZgmqywQZDC58PrWy', 'joshua@gmail.com', 1),
('adm003', 'Admin_Nizal', 'Nizal', '$2y$12$geAoA5Tnub9eLlOy2D8b/e5zgNafeSQJY6MgkCKSJVLzUeigrblfS', 'nizal@gmail.com', 1),
('adm004', 'Admin_Daffa', 'Daffa', '$2y$12$IG0OFBxrwdx46hrUiLo7.en/TRlAsLhdK9h0t/ziXbX4wjqlz4Y/K', 'daffa@gmail.com', 1),
('adm005', 'Admin_Irfan', 'Irfan', '$2y$12$a2gVCaQGPsKikUybgWxobOdiezUpxM/UwVW/lIlsjIpInE8uMcwo6', 'irfan@gmail.com', 1),
('adm006', 'Admin_Naufal', 'Naufal', '$2y$12$fEzwk1RSsq0AtdJD4xSFMOuUGlB41zM9G6Wuts86.Zs0jTJcR57Hu', 'naufal@gmail.com', 1),
('adm007', 'Admin_Zaidan', 'Zaidan', '$2y$12$viOCf4LpoeSP5/1A0/wsjeya1xTOp1R7H9bnWF38QBwz/Y7mZgn7S', 'zaidan@gmail.com', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `destcategory`
--

CREATE TABLE `destcategory` (
  `destCategoryID` varchar(6) NOT NULL,
  `categoryName` varchar(20) NOT NULL,
  `categoryImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `destcategory`
--

INSERT INTO `destcategory` (`destCategoryID`, `categoryName`, `categoryImage`) VALUES
('ctg001', 'Nature', 'destcategories/Nature.png'),
('ctg002', 'History', 'destcategories/History.jpg'),
('ctg003', 'Ecotourism', 'destcategories/Ecotourism.png'),
('ctg004', 'Beach', 'destcategories/Beach.jpg'),
('ctg005', 'Culture', 'destcategories/Culture.jpg'),
('ctg006', 'Education', 'destcategories/Education.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `destination`
--

CREATE TABLE `destination` (
  `destinationID` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `openingHours` time NOT NULL,
  `closingHours` time NOT NULL,
  `timezone` varchar(15) NOT NULL,
  `openingDay` varchar(15) NOT NULL,
  `closingDay` varchar(15) NOT NULL,
  `entranceFee` int NOT NULL,
  `description` text NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `thumbnailImagePath` varchar(255) NOT NULL,
  `destCategoryID` varchar(6) NOT NULL,
  `adminID` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `destination`
--

INSERT INTO `destination` (`destinationID`, `name`, `location`, `openingHours`, `closingHours`, `timezone`, `openingDay`, `closingDay`, `entranceFee`, `description`, `imagePath`, `thumbnailImagePath`, `destCategoryID`, `adminID`, `deleted_at`) VALUES
('dst001', 'Danau Weekuri', 'Kabupaten Sumba Barat Daya, Nusa Tenggara Timur', '08:00:00', '17:00:00', 'WITA', 'Senin', 'Minggu', 10000, 'Danau Weekuri adalah sebuah danau unik yang terletak di Desa Kelapa Lima, Kecamatan Kodi Utara, Kabupaten Sumba Barat Daya, Nusa Tenggara Timur (NTT). Dikenal juga dengan sebutan Danau Air Asin Weekuri, tempat ini merupakan salah satu keajaiban alam paling menakjubkan di Pulau Sumba. Berbeda dengan danau pada umumnya yang berisi air tawar, air di Danau Weekuri berasal dari air laut yang masuk melalui celah-celah batu karang, menjadikannya sebagai laguna alami dengan perpaduan warna biru muda, hijau toska, dan jernih transparan yang memanjakan mata. Pemandangan di sekitar danau sangat mempesona — airnya begitu tenang, dikelilingi batu karang tinggi dan vegetasi hijau yang menambah kesan alami serta menenangkan. Dengan kedalaman yang bervariasi, mulai dari sekitar satu meter di tepi hingga lebih dari lima meter di bagian tengah, Danau Weekuri menjadi tempat ideal untuk berenang, bersantai, atau sekadar menikmati keindahan alam. Cahaya matahari yang memantul di permukaan air menciptakan gradasi warna yang memukau, terutama pada siang hari saat langit cerah. Nama “Weekuri” sendiri berasal dari bahasa daerah Sumba yang berarti “air yang memercik”, menggambarkan proses alami masuknya air laut ke dalam danau melalui celah-celah batu karang di tepi pantai. Suara ombak yang menghantam karang dari laut lepas pun menjadi harmoni alami yang menambah suasana damai di tempat ini.\r\n    \r\n    Selain keindahan visualnya, Danau Weekuri juga memiliki daya tarik ekowisata dan budaya yang kuat. Kawasan ini masih sangat alami dan belum banyak tersentuh modernisasi, menjadikannya destinasi sempurna bagi wisatawan yang mencari ketenangan jauh dari keramaian kota. Dari atas tebing di sekitar danau, pengunjung dapat menikmati panorama spektakuler laut lepas Samudra Hindia di satu sisi dan ketenangan air biru Danau Weekuri di sisi lainnya. Di sore hari, suasana menjadi semakin magis dengan sinar matahari terbenam yang memantulkan warna keemasan di permukaan air. Selain sebagai tempat wisata, danau ini juga memiliki nilai penting bagi masyarakat sekitar, yang menjadikannya sebagai sumber kebanggaan dan simbol keharmonisan antara manusia dan alam. Warga setempat turut menjaga kebersihan serta kelestariannya agar keindahan Weekuri tetap terpelihara untuk generasi berikutnya. Akses menuju Danau Weekuri kini semakin mudah dengan adanya jalan beraspal dari Tambolaka, ibu kota Kabupaten Sumba Barat Daya, yang dapat ditempuh sekitar 1–1,5 jam perjalanan. Di sekitar kawasan danau juga sudah tersedia fasilitas sederhana seperti area parkir, tempat istirahat, gazebo bambu, serta tangga menuju air. Namun, suasana alami dan kesederhanaan inilah yang menjadi daya tarik utama Weekuri, membuat siapa pun yang datang merasa dekat dengan alam. Dengan pesona warna air yang luar biasa, udara yang segar, serta keramahan masyarakat lokal, Danau Weekuri adalah surga tersembunyi di Sumba Barat Daya — tempat di mana keindahan alam, ketenangan jiwa, dan keaslian budaya berpadu menjadi satu pengalaman tak terlupakan.', 'destinations/image/GxXfM0rt0mQeK9pdjsHN86t3JPNqwT4vbVFN5FKe.jpg', 'destinations/thumbnailImage/OkEpL8NHoapcX1k2tO80pouSNsSrpmTatzFoEUGG.jpg', 'ctg001', 'adm001', NULL),
('dst002', 'Gunung Rinjani', 'Pulau Lombok, Nusa Tenggara Barat', '07:00:00', '17:00:00', 'WITA', 'Senin', 'Minggu', 150000, 'Gunung Rinjani adalah salah satu gunung berapi tertinggi di Indonesia yang terletak di Pulau Lombok, Nusa Tenggara Barat, dengan ketinggian mencapai 3.726 meter di atas permukaan laut. Gunung ini merupakan bagian dari Taman Nasional Gunung Rinjani yang memiliki luas sekitar 41.330 hektare dan menjadi salah satu destinasi wisata alam paling populer di Indonesia maupun dunia. Keindahan alamnya yang memukau menjadikan Gunung Rinjani sebagai ikon kebanggaan masyarakat Lombok. Di kawasan gunung ini, wisatawan dapat menemukan beragam keajaiban alam seperti Danau Segara Anak, sebuah danau kawah berwarna biru kehijauan yang terbentuk akibat letusan besar pada masa lalu. Di tengah danau tersebut berdiri sebuah gunung kecil bernama Gunung Barujari, yang sering disebut “anak Rinjani”. Selain danau yang menakjubkan, panorama Rinjani juga dihiasi dengan hamparan padang rumput, hutan tropis yang lebat, air terjun yang mempesona, hingga jalur pendakian menantang dengan pemandangan matahari terbit dan terbenam yang spektakuler. Gunung Rinjani tidak hanya menawarkan pesona visual yang luar biasa, tetapi juga memiliki nilai spiritual dan budaya yang tinggi bagi masyarakat setempat. Bagi masyarakat Suku Sasak di Lombok dan sebagian masyarakat Bali, gunung ini dianggap sebagai tempat suci yang dihormati karena diyakini sebagai tempat bersemayamnya para dewa dan roh leluhur. Upacara keagamaan seperti Pekelan dan Mulang Pakelem sering diadakan di sekitar Danau Segara Anak sebagai bentuk rasa syukur dan penghormatan terhadap alam.\r\n\r\n    Selain keindahan alam dan nilai spiritualnya, Gunung Rinjani juga memiliki peran penting dalam aspek ekologi dan pariwisata. Ekosistem di kawasan ini menyimpan keanekaragaman hayati yang sangat tinggi. Berbagai jenis flora seperti edelweis, cemara gunung, dan beragam tanaman tropis tumbuh subur di lereng-lerengnya. Fauna seperti monyet ekor panjang, burung kakatua kecil jambul kuning, ayam hutan, hingga beberapa jenis reptil juga hidup di dalamnya. Karena keindahan dan keanekaragaman alam tersebut, kawasan Rinjani telah diakui secara internasional dengan masuk ke dalam jaringan geopark dunia UNESCO pada tahun 2018. Gunung ini juga menjadi magnet bagi pendaki dari seluruh penjuru dunia yang ingin menaklukkan jalur menantang namun memuaskan, terutama rute populer seperti Sembalun, Senaru, dan Torean. Pendakian ke puncak Gunung Rinjani menjadi pengalaman yang tidak hanya menguji fisik, tetapi juga memperkaya batin, karena setiap langkah disertai pemandangan luar biasa dari hutan, lembah, hingga puncak dengan panorama seluruh Lombok dan sebagian Bali di kejauhan. Di balik pesonanya, Gunung Rinjani juga menjadi simbol keseimbangan antara manusia dan alam. Pemerintah bersama masyarakat sekitar terus berupaya menjaga kelestarian lingkungan gunung ini agar tetap lestari dan berkelanjutan. Oleh karena itu, Gunung Rinjani bukan hanya sekadar objek wisata, tetapi juga warisan alam dan budaya Indonesia yang harus dijaga, dihormati, dan dilestarikan. Dengan pesonanya yang memikat, Rinjani menjadi bukti nyata keindahan dan kekayaan alam Nusantara yang tak ternilai harganya.', 'destinations/image/9G19cn2KNqscnTcfKmeMfUDPPhNJh3jS8yUfVyRE.jpg', 'destinations/thumbnailImage/Jru103JQPunexa2hZ07NjXkf38grIJbhEqiB1Skj.jpg', 'ctg001', 'adm001', NULL),
('dst003', 'Bukit Merese', 'Kabupaten Lombok Tengah, Nusa Tenggara Barat', '05:00:00', '19:00:00', 'WITA', 'Senin', 'Minggu', 10000, 'Bukit Merese adalah salah satu destinasi wisata alam paling terkenal di Pulau Lombok, Nusa Tenggara Barat. Terletak di kawasan Pantai Tanjung Aan, Kecamatan Pujut, Kabupaten Lombok Tengah, Bukit Merese menjadi tempat favorit bagi wisatawan lokal maupun mancanegara untuk menikmati keindahan panorama alam dari ketinggian. Bukit ini menawarkan pemandangan yang luar biasa indah, berupa hamparan laut biru yang berpadu dengan perbukitan hijau serta garis pantai yang memanjang di sepanjang pesisir selatan Lombok. Dari puncak bukit, pengunjung dapat menyaksikan pemandangan 360 derajat yang mencakup Pantai Tanjung Aan di sebelah timur dan Pantai Seger di sebelah barat. Nama “Merese” sendiri berasal dari bahasa Sasak yang berarti “meres” atau “beristirahat”, menggambarkan suasana tenang dan damai yang dirasakan siapa pun yang datang ke tempat ini. Bukit Merese terkenal sebagai spot terbaik untuk menikmati matahari terbit (sunrise) maupun matahari terbenam (sunset), karena dari sini pengunjung dapat melihat mentari perlahan muncul atau tenggelam di balik cakrawala laut dengan latar langit berwarna oranye keemasan. Angin sejuk yang berhembus lembut, padang rumput luas, serta suara deburan ombak dari kejauhan menambah kesan magis dan romantis di bukit ini.\r\n\r\n    Selain keindahan alamnya, Bukit Merese juga memiliki nilai ekowisata dan budaya yang menarik. Kawasan ini masih sangat alami, dengan hamparan rumput hijau yang berubah warna menjadi kecokelatan di musim kemarau, menciptakan lanskap yang berbeda di setiap waktu. Bukit ini menjadi salah satu lokasi favorit fotografer dan pembuat konten karena keindahan alamnya yang fotogenik dan pemandangannya yang menenangkan. Di sekitar bukit, terdapat berbagai destinasi menarik seperti Pantai Batu Payung, Pantai Seger, serta Desa Adat Sade dan Ende, tempat wisatawan dapat mengenal lebih dalam budaya dan kehidupan masyarakat Suku Sasak. Bukit Merese juga sering menjadi lokasi acara pariwisata seperti Festival Bau Nyale, tradisi tahunan masyarakat Sasak yang mencari cacing laut sebagai simbol legenda Putri Mandalika. Akses menuju Bukit Merese sangat mudah — hanya sekitar 30 menit dari Bandara Internasional Lombok, dan sekitar 10 menit dari kawasan wisata Mandalika yang kini menjadi salah satu destinasi super prioritas nasional. Fasilitas di sekitar area juga cukup memadai, dengan tersedianya area parkir, warung makan sederhana, serta pemandu lokal yang siap membantu pengunjung. Meskipun begitu, keaslian alam dan suasana tenangnya tetap terjaga, menjadikan Bukit Merese tempat sempurna untuk melepas penat dan menikmati keindahan alam Lombok dalam ketenangan. Dengan perpaduan pesona laut, langit, dan padang hijau, Bukit Merese merupakan surga kecil di selatan Lombok — sebuah tempat di mana keindahan alam berpadu dengan budaya lokal, menghadirkan pengalaman wisata yang tak hanya indah dipandang mata, tetapi juga menenangkan hati.', 'destinations/image/FWQjn3D35MjH1HNRbMH7zUNuaFs5DyqgaKeYmAQG.jpg', 'destinations/thumbnailImage/x9mHJgSmPAkPzq2g0xz21k9M2ra2SAyK2xO7deId.jpg', 'ctg001', 'adm001', NULL),
('dst004', 'Candi Borobudur', 'Magelang, Jawa Tengah', '06:00:00', '17:00:00', 'WIB', 'Senin', 'Minggu', 50000, 'Candi Borobudur adalah salah satu warisan budaya dan sejarah paling megah di dunia yang terletak di Magelang, Jawa Tengah, Indonesia. Candi ini merupakan candi Buddha terbesar di dunia dan menjadi salah satu simbol kejayaan peradaban Nusantara pada masa lampau. Dibangun pada masa Dinasti Syailendra sekitar abad ke-8 hingga ke-9 Masehi, Borobudur menggambarkan kebesaran arsitektur dan spiritualitas umat Buddha di masa itu. Struktur candi ini berbentuk piramida berundak yang terdiri dari sembilan tingkat, yakni enam teras berbentuk bujur sangkar di bagian bawah dan tiga teras melingkar di bagian atas. Di puncaknya terdapat satu stupa besar yang menjadi pusat dari keseluruhan bangunan. Secara keseluruhan, Borobudur memiliki 2.672 panel relief dan 504 arca Buddha, yang semuanya dipahat dengan detail luar biasa menggunakan batu andesit. Relief-relief tersebut menggambarkan ajaran moral, kehidupan manusia, serta perjalanan spiritual menuju pencerahan atau nirwana. Dari atas candi, pengunjung dapat menyaksikan panorama alam yang menakjubkan — deretan pegunungan seperti Gunung Merapi, Merbabu, Sindoro, dan Sumbing terlihat jelas mengelilingi kawasan candi, memberikan nuansa damai dan sakral yang seolah membawa pengunjung pada suasana masa lalu yang penuh makna.\r\n    \r\n    Selain nilai sejarah dan arsitekturnya yang menakjubkan, Candi Borobudur juga memiliki makna spiritual dan simbolisme yang mendalam. Setiap tingkat candi melambangkan tahapan kehidupan manusia dalam ajaran Buddha, mulai dari Kamadhatu (dunia nafsu), Rupadhatu (dunia bentuk), hingga Arupadhatu (dunia tanpa bentuk), yang menggambarkan perjalanan manusia menuju kesempurnaan batin. Candi ini sempat terlupakan selama berabad-abad setelah tertimbun abu vulkanik dan semak belukar, hingga akhirnya ditemukan kembali pada tahun 1814 oleh Thomas Stamford Raffles, Gubernur Jenderal Inggris di Jawa saat itu. Sejak saat itu, Borobudur mengalami beberapa tahap pemugaran besar, termasuk yang paling monumental dilakukan oleh pemerintah Indonesia dan UNESCO pada tahun 1975–1982. Kini, Borobudur telah ditetapkan sebagai Situs Warisan Dunia oleh UNESCO sejak tahun 1991 karena nilai sejarah, budaya, dan arsitekturnya yang luar biasa. Selain menjadi objek wisata unggulan Indonesia, Borobudur juga berfungsi sebagai tempat ibadah dan perayaan keagamaan, terutama pada Hari Raya Waisak, yang setiap tahunnya menarik ribuan umat Buddha dari seluruh dunia. Dengan kemegahan arsitektur, nilai spiritual, dan keindahan alam di sekitarnya, Candi Borobudur tidak hanya menjadi kebanggaan Indonesia, tetapi juga simbol perdamaian dan pencerahan bagi umat manusia. Keberadaannya menjadi bukti nyata bahwa peradaban Nusantara pernah mencapai tingkat kebudayaan tinggi yang sarat dengan filosofi, seni, dan kebijaksanaan spiritual yang tak lekang oleh waktu.', 'destinations/image/wKVMGKiZSh4eAo7NRgKYbNNELSImoYhDIu8IWLLr.jpg', 'destinations/thumbnailImage/Z6NOINhNtQgb0N3sWAGYSyNypnjBI3RAvw2DmbBD.jpg', 'ctg002', 'adm001', NULL),
('dst005', 'Candi Prambanan', 'Sleman, Yogyakarta', '06:00:00', '17:00:00', 'WIB', 'Senin', 'Minggu', 150000, 'Candi Prambanan adalah kompleks candi Hindu terbesar dan termegah di Indonesia yang terletak di perbatasan antara Kabupaten Sleman, Daerah Istimewa Yogyakarta, dan Kabupaten Klaten, Jawa Tengah. Candi ini dibangun sekitar abad ke-9 Masehi oleh Rakai Pikatan dari Wangsa Sanjaya sebagai persembahan untuk Trimurti, yaitu tiga dewa utama dalam agama Hindu: Brahma (Sang Pencipta), Wisnu (Sang Pemelihara), dan Siwa (Sang Pelebur). Karena itu, Prambanan juga dikenal dengan nama Candi Rara Jonggrang, yang berasal dari legenda rakyat tentang Putri Rara Jonggrang dan Bandung Bondowoso. Kompleks Candi Prambanan terdiri dari lebih dari 240 candi, meskipun kini sebagian besar hanya tersisa reruntuhannya akibat gempa dan waktu. Bangunan utamanya terdapat tiga candi besar di bagian tengah, yaitu Candi Siwa setinggi 47 meter sebagai candi utama, diapit oleh Candi Brahma dan Candi Wisnu di sisi kiri dan kanan. Ketiganya dikelilingi oleh candi-candi kecil yang disebut perwara, serta beberapa candi pengiring seperti Candi Nandi, Candi Garuda, dan Candi Angsa. Seluruh kompleks dibangun dengan struktur batu andesit dan dihiasi relief yang dipahat dengan sangat detail, menggambarkan kisah-kisah epik dari kitab Ramayana dan Kresnayana.\r\n\r\n    Selain sebagai monumen keagamaan, Candi Prambanan juga menjadi simbol kebesaran dan keindahan arsitektur Hindu klasik di Nusantara. Setiap relief, ukiran, dan susunan batu di candi ini memiliki makna filosofis yang mendalam, menggambarkan keseimbangan antara kehidupan manusia, alam, dan kekuatan ilahi. Di dalam Candi Siwa, misalnya, terdapat arca Siwa Mahadewa yang berdiri megah, melambangkan kekuatan dan kebijaksanaan tertinggi dalam ajaran Hindu. Keindahan arsitektur Prambanan tidak hanya terlihat pada bangunannya, tetapi juga pada penataan ruangnya yang simetris dan harmonis, mencerminkan tatanan kosmos menurut kepercayaan Hindu. Setelah sempat mengalami kerusakan akibat gempa besar di masa lampau, Prambanan mulai dipugar secara bertahap sejak tahun 1930-an dan terus dilestarikan hingga kini. Pada tahun 1991, Candi Prambanan resmi ditetapkan sebagai Situs Warisan Dunia oleh UNESCO, bersama dengan Candi Borobudur. Kini, Prambanan menjadi salah satu destinasi wisata budaya paling populer di Indonesia dan dunia. Setiap tahun, ribuan wisatawan datang untuk mengagumi kemegahannya, terutama saat digelar pertunjukan Sendratari Ramayana, sebuah pementasan seni yang menggabungkan tari, musik, dan kisah klasik Hindu di pelataran candi dengan latar megah bangunan kuno yang diterangi cahaya malam. Dengan pesona sejarah, nilai spiritual, dan keindahan arsitektur yang luar biasa, Candi Prambanan bukan hanya warisan budaya bangsa, tetapi juga lambang harmoni antara manusia, seni, dan keagungan Sang Pencipta — sebuah mahakarya yang membuktikan kejayaan peradaban Hindu di tanah Jawa.', 'destinations/image/sBBVjGZmm7rcwaMEUfYQsIqz2h3Cw4M1Awz1im11.jpg', 'destinations/thumbnailImage/gTAnjdweyCpBtco74SYQCwrRBL8lDFm1A59fHIg8.jpg', 'ctg002', 'adm001', NULL),
('dst006', 'Monumen Nasional (Monas)', 'Jakarta Pusat, DKI Jakarta', '08:00:00', '17:00:00', 'WIB', 'Senin', 'Minggu', 30000, 'Monumen Nasional (Monas) adalah ikon kebanggaan bangsa Indonesia yang terletak di pusat Kota Jakarta, tepatnya di Lapangan Medan Merdeka. Monas dibangun sebagai simbol perjuangan rakyat Indonesia dalam merebut kemerdekaan dari penjajahan, sekaligus menjadi pengingat semangat nasionalisme dan cinta tanah air. Pembangunan monumen ini dimulai pada 17 Agustus 1961 atas prakarsa Presiden Soekarno, dan diresmikan untuk umum pada 12 Juli 1975. Monas memiliki tinggi sekitar 132 meter dan dirancang oleh arsitek Friedrich Silaban serta R.M. Soedarsono, dengan gaya arsitektur yang sarat makna filosofis. Bangunan utama berbentuk obelis menjulang ke langit, berdiri di atas pelataran persegi yang melambangkan semangat kokoh rakyat Indonesia. Di puncaknya terdapat lidah api yang terbuat dari perunggu seberat 14,5 ton, dilapisi emas murni seberat 50 kilogram. Api tersebut disebut “Api Abadi Kemerdekaan”, yang menyimbolkan semangat perjuangan bangsa Indonesia yang tidak pernah padam. Bagian bawah monumen terdapat museum sejarah nasional yang berisi diorama dan koleksi yang menceritakan perjalanan panjang bangsa Indonesia dari masa penjajahan hingga proklamasi kemerdekaan tahun 1945. Selain itu, pengunjung dapat naik ke pelataran puncak Monas menggunakan lift untuk menikmati panorama Kota Jakarta dari ketinggian, terutama pada malam hari ketika cahaya lampu kota berpadu indah dengan gemerlap Monas yang diterangi lampu sorot warna-warni.\r\n\r\n    Lebih dari sekadar bangunan monumental, Monas memiliki nilai simbolis, sejarah, dan edukatif yang sangat tinggi. Bentuk keseluruhan monumen mencerminkan filosofi “lingga dan yoni”, simbol kesuburan dan keseimbangan antara unsur laki-laki dan perempuan dalam budaya Indonesia, yang sekaligus melambangkan keberlangsungan hidup bangsa. Kawasan di sekeliling Monas kini menjadi taman kota terbuka yang asri dan menjadi ruang publik favorit warga Jakarta untuk berolahraga, bersantai, hingga menikmati suasana kota. Di area sekitar monumen juga sering digelar berbagai acara nasional, seperti upacara peringatan Hari Kemerdekaan, festival budaya, dan konser rakyat. Monas tidak hanya menjadi daya tarik wisata sejarah, tetapi juga pusat edukasi dan identitas nasional yang mengingatkan generasi muda akan perjuangan dan pengorbanan para pahlawan. Lokasinya yang strategis membuat Monas mudah dijangkau dari berbagai arah, baik menggunakan kendaraan pribadi maupun transportasi umum seperti TransJakarta dan MRT. Sebagai salah satu landmark paling terkenal di Indonesia, Monas menjadi destinasi wajib bagi wisatawan yang berkunjung ke Jakarta. Dengan kemegahan arsitektur, keindahan taman di sekitarnya, serta nilai historis yang mendalam, Monumen Nasional (Monas) bukan hanya sekadar monumen, tetapi simbol keabadian semangat kemerdekaan dan kebanggaan bangsa Indonesia yang terus menyala di hati setiap warga negara.', 'destinations/image/xVCHrIeT3XCUXnwJGXGu2CqOENFKa3NtilsMJChU.jpg', 'destinations/thumbnailImage/HDGNRxBmmj7ZBTEblAcFJD1FBqfgD7TQTSJEb6wA.jpg', 'ctg002', 'adm001', NULL),
('dst007', 'Taman Nasional Komodo', 'Manggarai Barat, Nusa Tenggara Timur', '06:00:00', '18:00:00', 'WITA', 'Senin', 'Minggu', 50000, 'Taman Nasional Komodo adalah salah satu destinasi wisata paling terkenal di Indonesia dan dunia, terletak di Kepulauan Nusa Tenggara, tepatnya di antara Pulau Sumbawa dan Pulau Flores. Kawasan ini terdiri dari tiga pulau besar — Pulau Komodo, Pulau Rinca, dan Pulau Padar — serta beberapa pulau kecil lainnya yang semuanya memiliki keindahan alam yang luar biasa. Didirikan pada tahun 1980 dan diakui sebagai Warisan Dunia UNESCO pada tahun 1991, Taman Nasional Komodo awalnya dibentuk untuk melindungi hewan purba langka Komodo (Varanus komodoensis), spesies kadal terbesar di dunia yang hanya hidup secara alami di kawasan ini.Komodo dapat tumbuh hingga lebih dari tiga meter dan memiliki gigitan beracun yang mematikan bagi mangsanya, menjadikannya predator puncak di ekosistem pulau. Selain keberadaan komodo, taman nasional ini juga memiliki keanekaragaman hayati yang menakjubkan, baik di darat maupun di bawah laut. Pemandangan alamnya berupa savana luas, bukit-bukit kering, pantai berpasir putih hingga Pantai Pink yang ikonik, serta lautan biru dengan terumbu karang yang masih sangat terjaga. Perpaduan ekosistem darat dan laut ini menjadikan Taman Nasional Komodo sebagai salah satu tempat terbaik di dunia untuk menikmati petualangan alam, snorkeling, diving, dan trekking sambil menyaksikan langsung keajaiban alam yang belum banyak tersentuh.\r\n\r\n    Selain pesona alamnya yang menakjubkan, Taman Nasional Komodo juga menjadi simbol konservasi dan pariwisata berkelanjutan di Indonesia. Kawasan ini dikelola dengan tujuan menjaga keseimbangan antara pelestarian alam dan pengembangan ekonomi masyarakat lokal. Pengunjung dapat menjelajahi pulau-pulau di taman nasional melalui tur dengan pemandu resmi yang memastikan keselamatan serta meminimalkan gangguan terhadap habitat komodo. Aktivitas populer di sini antara lain trekking di Pulau Rinca dan Pulau Komodo untuk mengamati komodo di alam liar, menikmati panorama spektakuler dari Puncak Pulau Padar, hingga menyelam di lokasi-lokasi kelas dunia seperti Manta Point dan Batu Bolong, yang dikenal dengan arus lautnya yang kuat namun penuh kehidupan laut. Di sekitar kawasan taman nasional, terdapat pula desa-desa tradisional seperti Desa Komodo dan Desa Rinca, tempat wisatawan dapat melihat langsung kehidupan masyarakat setempat yang masih mempertahankan budaya dan tradisi mereka. Dengan segala pesonanya, Taman Nasional Komodo bukan hanya kebanggaan Indonesia, tetapi juga ikon pariwisata internasional yang menegaskan pentingnya menjaga hubungan harmonis antara manusia dan alam. Setiap langkah di kawasan ini menghadirkan pengalaman tak terlupakan — dari menyaksikan langsung komodo yang gagah, menyelam bersama ikan pari manta, hingga menikmati senja di atas kapal pinisi yang berlayar di antara pulau-pulau eksotis — menjadikan Taman Nasional Komodo benar-benar layak disebut sebagai salah satu keajaiban alam dunia yang hidup.', 'destinations/image/Qk6YfPAJv0Rm9Zfxd9xt7H6FKnCjQwnii06oPs32.jpg', 'destinations/thumbnailImage/PT03feKTeO3vsJJvalQtoGwRmdrUZaiFvEZuVPom.jpg', 'ctg003', 'adm001', NULL),
('dst008', 'Taman Nasional Way Kambas', 'Lampung Timur, Lampung', '07:00:00', '18:00:00', 'WIB', 'Senin', 'Minggu', 25000, 'Taman Nasional Way Kambas adalah salah satu taman nasional tertua di Indonesia yang terletak di Provinsi Lampung, tepatnya di bagian timur Pulau Sumatra. Kawasan ini memiliki luas sekitar 125.000 hektare dan dikenal sebagai pusat konservasi gajah Sumatra (Elephas maximus sumatranus), salah satu spesies gajah endemik Indonesia yang kini terancam punah. Didirikan pada tahun 1985, taman nasional ini menjadi simbol upaya pelestarian satwa langka dan ekosistem hutan dataran rendah Sumatra. Lanskap Way Kambas didominasi oleh padang rumput, hutan rawa, dan hutan sekunder yang menjadi habitat ideal bagi berbagai satwa liar. Selain gajah, kawasan ini juga menjadi rumah bagi spesies langka lainnya seperti badak Sumatra, harimau Sumatra, tapir, rusa sambar, beruang madu, serta lebih dari 400 jenis burung. Daya tarik utama Way Kambas adalah Pusat Konservasi Gajah (Elephant Training Centre) yang berfungsi sebagai tempat pelatihan, rehabilitasi, dan pengembangbiakan gajah-gajah liar agar dapat hidup berdampingan dengan manusia secara harmonis. Di sini, pengunjung bisa melihat secara langsung proses pelatihan gajah, menonton atraksi edukatif, hingga ikut dalam kegiatan wisata konservasi seperti memberi makan dan memandikan gajah. Suasana alami dan udara segar khas hutan tropis menjadikan Way Kambas destinasi yang ideal bagi pecinta alam dan fotografi satwa liar.\r\n    \r\n    Lebih dari sekadar kawasan wisata, Taman Nasional Way Kambas memiliki peran penting dalam menjaga keseimbangan ekosistem dan keberlangsungan kehidupan satwa liar di Sumatra. Pemerintah bersama organisasi konservasi nasional maupun internasional terus berupaya menjaga kawasan ini dari ancaman perburuan liar, kebakaran hutan, dan perambahan lahan. Selain Pusat Konservasi Gajah, di dalam taman nasional juga terdapat Pusat Konservasi Badak Sumatra (Sumatran Rhino Sanctuary), yang berfokus pada penyelamatan dan pengembangbiakan badak Sumatra — salah satu mamalia paling langka di dunia. Wisatawan yang datang ke Way Kambas dapat merasakan pengalaman unik menyusuri hutan menggunakan kendaraan terbuka atau perahu kecil di sungai Way Kanan untuk mengamati flora dan fauna secara langsung. Tak hanya itu, kegiatan edukasi dan ekowisata di kawasan ini juga melibatkan masyarakat sekitar, sehingga memberikan manfaat ekonomi sekaligus menumbuhkan kesadaran pentingnya menjaga alam. Dengan perpaduan antara keindahan alam liar, nilai konservasi, dan edukasi lingkungan, Taman Nasional Way Kambas menjadi destinasi wisata yang tidak hanya memanjakan mata, tetapi juga menginspirasi tentang arti pentingnya pelestarian satwa dan alam Indonesia. Setiap langkah di taman ini memberikan pengalaman mendalam tentang bagaimana manusia dapat hidup selaras dengan alam, menjadikan Way Kambas bukan sekadar tempat wisata, melainkan warisan alam berharga yang mencerminkan semangat konservasi Indonesia.', 'destinations/image/5Dt7dJtSib8icUfgrPUeBxQ3EyaggRuR5FP6e2XQ.jpg', 'destinations/thumbnailImage/DFkBTafMCmWiosOjBNMK1ho8Gwtz6BJCbq8jrLnZ.jpg', 'ctg003', 'adm001', NULL),
('dst009', 'Taman Nasional Gunung Leuser', 'Aceh, Sumatra Utara', '07:00:00', '17:00:00', 'WIB', 'Senin', 'Minggu', 20000, 'Taman Nasional Gunung Leuser adalah salah satu kawasan konservasi paling penting dan megah di Indonesia yang terletak di Provinsi Aceh dan Sumatera Utara. Kawasan ini memiliki luas lebih dari 1,09 juta hektare dan merupakan bagian dari Warisan Hutan Hujan Tropis Sumatera (Tropical Rainforest Heritage of Sumatra) yang diakui sebagai Warisan Dunia UNESCO sejak tahun 2004. Taman Nasional Gunung Leuser dikenal sebagai rumah bagi keanekaragaman hayati tertinggi di Asia Tenggara, dengan ribuan spesies flora dan fauna yang hidup di dalamnya. Salah satu daya tarik utamanya adalah keberadaan empat satwa besar yang terancam punah, yaitu orangutan Sumatra, gajah Sumatra, harimau Sumatra, dan badak Sumatra — menjadikannya satu-satunya tempat di dunia di mana keempat spesies langka ini masih dapat hidup berdampingan secara alami. Selain itu, taman nasional ini juga memiliki bentang alam yang luar biasa beragam, mulai dari pantai, hutan rawa, hutan dataran rendah, hingga pegunungan tinggi dengan puncak tertingginya yaitu Gunung Leuser (3.404 meter di atas permukaan laut). Lanskap yang begitu luas dan kompleks menjadikan kawasan ini surga bagi para petualang, peneliti, dan pecinta alam liar. Berbagai aktivitas wisata alam dapat dilakukan di sini, seperti trekking di Bukit Lawang untuk melihat orangutan di habitat aslinya, arung jeram di Sungai Alas, hingga pendakian menuju puncak Gunung Leuser yang menantang dan penuh pengalaman spiritual.\r\n\r\n    Lebih dari sekadar destinasi wisata, Taman Nasional Gunung Leuser juga menjadi simbol penting perjuangan konservasi dan pelestarian alam Indonesia. Kawasan ini memiliki peran vital dalam menjaga keseimbangan ekosistem, sumber air, dan stabilitas iklim di Pulau Sumatra. Di dalamnya hidup lebih dari 130 spesies mamalia, 320 jenis burung, serta ribuan jenis tumbuhan, termasuk rafflesia dan bunga bangkai (Amorphophallus titanum) — dua bunga terbesar di dunia. Pemerintah Indonesia bersama berbagai lembaga konservasi terus berupaya menjaga kelestarian kawasan ini dari ancaman deforestasi, perburuan liar, dan konversi lahan. Wisata di taman nasional ini dikembangkan dengan prinsip ekowisata berkelanjutan, di mana pengunjung diajak tidak hanya menikmati keindahan alam, tetapi juga memahami pentingnya menjaga lingkungan dan mendukung kehidupan masyarakat sekitar. Kawasan Bukit Lawang dan Tangkahan menjadi dua gerbang utama wisatawan untuk menjelajahi taman ini. Di Bukit Lawang, wisatawan dapat melihat pusat rehabilitasi orangutan dan menjelajahi hutan tropis yang masih perawan, sedangkan di Tangkahan, pengunjung bisa berinteraksi dengan gajah jinak dan menikmati pemandian alami di sungai jernih di tengah hutan. Dengan kombinasi antara keindahan alam yang megah, kekayaan biodiversitas, dan nilai konservasi yang tinggi, Taman Nasional Gunung Leuser adalah salah satu permata alam Indonesia yang tak ternilai — tempat di mana manusia bisa belajar tentang keseimbangan, keanekaragaman, dan kekuatan alam yang sesungguhnya.', 'destinations/image/bhbPy3iv8bk87U0HhkBfqT2xjalK3FVq4aV0DQbo.jpg', 'destinations/thumbnailImage/j3QrCUrG63dmcnZiPc6F2fjROSJKnhJiKwZkiHlq.jpg', 'ctg003', 'adm001', NULL),
('dst010', 'Pantai Ora', 'Pulau Seram, Maluku Tengah', '00:01:00', '23:59:00', 'WITA', 'Senin', 'Minggu', 25000, 'Pantai Ora adalah salah satu surga tersembunyi di Indonesia yang terletak di Desa Saleman, Kecamatan Seram Utara, Kabupaten Maluku Tengah, Provinsi Maluku. Pantai ini dikenal luas karena keindahannya yang sering disebut sebanding bahkan menyaingi destinasi tropis dunia seperti Maladewa atau Bora-Bora. Pantai Ora memiliki pesona luar biasa dengan air laut yang jernih sebening kaca, pasir putih halus, serta latar belakang perbukitan hijau yang menyejukkan mata. Air lautnya yang tenang memantulkan gradasi warna biru dan toska yang menawan, menciptakan panorama yang sangat fotogenik. Salah satu daya tarik utama Pantai Ora adalah kehidupan bawah lautnya yang mempesona, di mana wisatawan dapat langsung melihat terumbu karang dan ikan-ikan tropis berwarna-warni hanya dengan snorkeling di tepi pantai. Karena kejernihan airnya, pemandangan bawah laut bahkan bisa terlihat tanpa harus menyelam dalam-dalam. Di sepanjang pantai terdapat beberapa penginapan unik berupa resort terapung dan cottage kayu di atas air, seperti Ora Beach Resort, yang memberikan pengalaman menginap langsung di atas laut dengan suara ombak yang lembut dan pemandangan sunrise serta sunset yang spektakuler. Akses menuju Pantai Ora memang tidak mudah — wisatawan harus menempuh perjalanan darat dan laut dari Kota Ambon — namun semua rasa lelah akan terbayar lunas begitu tiba di lokasi yang penuh ketenangan dan keindahan alami ini.\r\n\r\n    Selain pesona visualnya yang luar biasa, Pantai Ora juga menjadi simbol keaslian alam dan harmoni kehidupan masyarakat pesisir Maluku. Kawasan ini masih sangat alami, jauh dari polusi dan hiruk pikuk kota, menjadikannya tempat ideal untuk beristirahat dan menyatu dengan alam. Masyarakat setempat hidup berdampingan dengan laut, menjaga kelestarian ekosistem dengan cara tradisional dan berkelanjutan. Aktivitas wisata di sini berfokus pada ekowisata dan konservasi laut, di mana pengunjung diajak untuk menikmati keindahan alam tanpa merusaknya. Selain snorkeling dan diving, wisatawan juga dapat menjelajahi kawasan sekitar seperti Taman Nasional Manusela, yang menawarkan keanekaragaman flora dan fauna endemik, serta Gua Laut Lisar Bahari yang menakjubkan. Pantai Ora bukan sekadar tempat wisata, melainkan juga simbol keindahan dan ketenangan Maluku, tempat di mana laut, langit, dan gunung berpadu dalam harmoni sempurna. Setiap detik yang dihabiskan di sini menghadirkan pengalaman spiritual tersendiri — suara ombak yang lembut, angin laut yang sejuk, serta panorama alam yang tiada duanya menjadikan Pantai Ora bagaikan potongan kecil surga di timur Indonesia. Keindahan dan keaslian Pantai Ora tidak hanya menjadi kebanggaan Maluku, tetapi juga salah satu bukti nyata betapa kaya dan menakjubkannya alam Indonesia yang patut dijaga dan dilestarikan.', 'destinations/image/DpA9IBCR3YWQyBAg73nFP0lHAZQ4UfKXk2x2X3di.jpg', 'destinations/thumbnailImage/bIHGbHujlZUTuX4rWldrGCp3fZiyrYT77SHlPGLT.jpg', 'ctg004', 'adm001', NULL),
('dst011', 'Pantai Gatra', 'Malang, Jawa Timur', '07:00:00', '17:00:00', 'WIB', 'Senin', 'Minggu', 10000, 'Pantai Gatra adalah salah satu destinasi wisata alam yang menawan di Kabupaten Malang, Provinsi Jawa Timur, tepatnya berada di kawasan Desa Sendang Biru, Kecamatan Sitiarjo. Pantai ini merupakan bagian dari Kawasan Konservasi Mangrove dan Pesisir Clungup Mangrove Conservation (CMC Tiga Warna), yang dikelola oleh masyarakat setempat dengan konsep ekowisata berkelanjutan. Pantai Gatra terkenal karena keindahannya yang masih sangat alami dan bersih, jauh dari hiruk pikuk keramaian kota. Berbeda dengan pantai-pantai wisata pada umumnya, jumlah pengunjung di sini dibatasi setiap harinya agar kelestarian alam tetap terjaga. Garis pantainya dihiasi pasir putih lembut dengan air laut berwarna biru kehijauan yang tenang karena terlindung oleh gugusan pulau-pulau kecil di depannya. Ombak yang tidak terlalu besar membuat Pantai Gatra aman untuk aktivitas seperti berenang, bermain air, atau sekadar menikmati pemandangan dari pinggir pantai. Dari kejauhan, terlihat deretan karang besar yang menambah keindahan panorama pantai ini, terutama saat matahari terbit dan terbenam yang menciptakan gradasi warna langit dan laut yang begitu memukau. Untuk mencapai lokasi Pantai Gatra, pengunjung perlu melakukan trekking ringan sejauh kurang lebih dua kilometer dari pos masuk CMC, melewati jalur alami dengan pepohonan hijau dan hutan mangrove yang rimbun — sebuah perjalanan yang justru menjadi bagian dari daya tarik wisata ini.\r\n\r\n    Selain keindahan alamnya yang luar biasa, Pantai Gatra juga memiliki nilai ekologis dan edukatif yang tinggi. Kawasan ini berfungsi sebagai zona konservasi alam, di mana setiap pengunjung diharuskan mengikuti aturan ketat untuk menjaga kebersihan dan kelestarian lingkungan. Aktivitas seperti membuang sampah sembarangan, membawa botol plastik sekali pakai, atau menyalakan api sembarangan sangat dilarang. Sebagai gantinya, pengunjung dapat menikmati pengalaman wisata yang lebih bermakna, seperti berkemah di tepi pantai, menanam mangrove, atau menyusuri pantai dengan kano sambil menikmati keheningan alam. Pihak pengelola lokal juga menyediakan fasilitas sederhana seperti area parkir, pos registrasi, tempat istirahat, dan area camping yang nyaman. Keberhasilan pengelolaan Pantai Gatra menjadi contoh nyata bagaimana pariwisata dapat berjalan seiring dengan pelestarian lingkungan. Wisatawan tidak hanya diajak menikmati keindahan alam, tetapi juga belajar untuk menghargai dan menjaga ekosistem pesisir. Selain itu, masyarakat sekitar ikut diberdayakan dalam kegiatan wisata ini, mulai dari menjadi pemandu, penjaga kawasan, hingga penyedia jasa logistik bagi pengunjung. Dengan perpaduan antara keindahan alam, kesadaran lingkungan, dan keterlibatan masyarakat, Pantai Gatra bukan hanya sekadar tempat rekreasi, tetapi juga simbol keberhasilan ekowisata berbasis komunitas di Indonesia. Suasana tenang, udara segar, serta pemandangan laut yang mempesona menjadikan Pantai Gatra destinasi sempurna bagi siapa pun yang ingin merasakan keindahan alam sejati sekaligus berkontribusi dalam menjaga kelestarian bumi.', 'destinations/image/4RtZb1cYOMCbCaOyXoAf3PvWvZp8IhT8DyLvpaIi.jpg', 'destinations/thumbnailImage/MSm9GPXifxGZERHqt2CnKIoZPjlw1fURYMPskF9c.jpg', 'ctg004', 'adm001', NULL),
('dst012', 'Pantai Tanjung Aan', 'Lombok Tengah, Nusa Tenggara Barat', '06:00:00', '18:00:00', 'WITA', 'Senin', 'Minggu', 10000, 'Pantai Tanjung Aan adalah salah satu pantai terindah di Pulau Lombok, Nusa Tenggara Barat, yang terletak di Desa Sengkol, Kecamatan Pujut, Kabupaten Lombok Tengah, tidak jauh dari kawasan wisata Mandalika. Pantai ini terkenal karena keunikan pasirnya yang memiliki dua tekstur berbeda — di satu sisi butirannya halus seperti tepung, sementara di sisi lainnya berbentuk bulat-bulat kecil menyerupai biji merica, sehingga sering disebut juga sebagai “Pantai Merica” oleh masyarakat setempat. Garis pantainya yang panjang membentuk lengkungan indah seperti teluk, dengan air laut berwarna biru toska yang jernih dan ombak yang lembut, menciptakan suasana tenang dan menenangkan. Dikelilingi oleh perbukitan hijau seperti Bukit Merese di sebelah barat dan Bukit Batu Payung di sisi timur, Pantai Tanjung Aan menawarkan pemandangan alam yang menakjubkan dari berbagai sudut. Pemandangan matahari terbit di pantai ini menjadi salah satu momen paling mempesona, ketika sinar mentari perlahan muncul dari balik perbukitan dan memantul di permukaan air laut yang berkilau. Pantai ini juga menjadi salah satu lokasi terbaik untuk berenang, snorkeling, atau sekadar bermain pasir karena ombaknya relatif tenang dan dangkal di beberapa bagian. Keindahan alam yang masih alami, dipadukan dengan suasana damai tanpa hiruk pikuk, membuat Tanjung Aan menjadi destinasi favorit bagi wisatawan lokal maupun mancanegara yang mencari ketenangan di tengah keindahan tropis Lombok.\r\n\r\n    Selain panorama alamnya yang luar biasa, Pantai Tanjung Aan juga memiliki nilai budaya dan legenda yang menarik. Pantai ini menjadi salah satu lokasi utama penyelenggaraan Festival Bau Nyale, tradisi tahunan masyarakat Sasak yang dilakukan untuk mengenang kisah Putri Mandalika — seorang putri cantik yang memilih mengorbankan diri demi kedamaian rakyatnya, dan dipercaya menjelma menjadi cacing laut bernama “nyale”. Setiap tahun, ribuan masyarakat dan wisatawan datang ke Tanjung Aan untuk mengikuti ritual pencarian nyale di pesisir pantai, menjadikannya perayaan budaya yang penuh warna dan kebersamaan. Selain nilai budaya, kawasan Tanjung Aan juga berkembang menjadi bagian penting dari destinasi wisata super prioritas Mandalika Resort Area, dengan pembangunan yang tetap memperhatikan kelestarian lingkungan. Akses menuju pantai ini sangat mudah — hanya sekitar 15 menit dari Sirkuit Mandalika dan 30 menit dari Bandara Internasional Lombok Zainuddin Abdul Madjid. Di sekitar pantai telah tersedia fasilitas pendukung seperti area parkir, warung makan, gazebo bambu, serta penyewaan payung pantai dan papan selancar. Meski fasilitasnya semakin lengkap, suasana alami dan kebersihan pantai tetap terjaga berkat kerja sama masyarakat lokal dan pengelola wisata. Dengan kombinasi antara keindahan alam, kekayaan budaya, serta keramahan masyarakatnya, Pantai Tanjung Aan adalah salah satu permata wisata Lombok Selatan — tempat di mana langit biru, laut jernih, dan legenda setempat berpadu menciptakan pengalaman yang tak terlupakan bagi siapa pun yang datang berkunjung.', 'destinations/image/QG9zj5k4xv3rv6aecwwWHmjvfk40Jt4LVh0LBoW0.jpg', 'destinations/thumbnailImage/rMyHmuAOtczUFlqBYJ9ifXtSfxFRxccrtCIefZ15.jpg', 'ctg004', 'adm001', NULL),
('dst013', 'Floating Market Lembang', 'Lembang, Kabupaten Bandung Barat', '09:00:00', '18:00:00', 'WIB', 'Senin', 'Minggu', 35000, 'Floating Market Lembang adalah salah satu destinasi wisata unik dan populer di Lembang, Kabupaten Bandung Barat, Provinsi Jawa Barat, yang menawarkan pengalaman berbelanja dan bersantap di atas air dengan suasana sejuk khas pegunungan. Berlokasi di kawasan dataran tinggi yang dikelilingi perbukitan hijau dan udara segar, Floating Market Lembang menghadirkan konsep wisata kuliner dan rekreasi keluarga yang berpadu dengan keindahan alam. Seperti namanya, tempat ini mengusung konsep pasar terapung, di mana para pedagang menjajakan makanan dan minuman khas Nusantara menggunakan perahu kayu yang mengapung di atas danau alami. Pengunjung dapat membeli aneka kuliner seperti batagor, sate kelinci, nasi liwet, jagung bakar, hingga minuman tradisional dengan menggunakan koin khusus yang ditukar di loket utama. Konsep ini tidak hanya menghadirkan sensasi kuliner yang berbeda, tetapi juga memperkuat nuansa tradisional yang khas dan ramah keluarga. Selain wisata kuliner, Floating Market juga dilengkapi dengan berbagai wahana menarik seperti Kampung Leuit, Rainbow Garden, Kota Mini Lembang, wahana air, taman kelinci, hingga area spot foto tematik yang sangat digemari wisatawan muda. Suasana damai di sekitar danau dengan latar pegunungan dan hamparan taman bunga yang berwarna-warni menjadikan tempat ini cocok untuk melepas penat sekaligus berfoto ria bersama keluarga maupun sahabat.\r\n\r\n    Lebih dari sekadar tempat wisata kuliner, Floating Market Lembang merupakan destinasi edukatif dan rekreatif yang menonjolkan budaya lokal dan keindahan alam Bandung Utara. Pengelolaan kawasan ini memperhatikan kebersihan dan kelestarian lingkungan, sehingga suasananya tetap asri dan nyaman untuk dikunjungi. Di sini, pengunjung juga bisa mencoba berbagai aktivitas seru seperti berperahu mengelilingi danau, memberi makan ikan, atau belajar membuat makanan tradisional di area edukasi anak. Bagi yang ingin menikmati suasana lebih tenang, tersedia gazebo dan tempat duduk di tepi danau, lengkap dengan panorama alam yang menyejukkan mata. Floating Market Lembang juga menjadi tempat favorit untuk acara keluarga, foto prewedding, hingga kunjungan rombongan sekolah karena menggabungkan unsur hiburan, edukasi, dan budaya dalam satu tempat. Lokasinya sangat strategis, hanya sekitar 15 menit dari pusat Kota Lembang dan mudah dijangkau dari Bandung melalui jalur Setiabudi atau Punclut. Dengan konsep wisata yang inovatif dan fasilitas lengkap seperti area parkir luas, mushola, restoran, dan toko oleh-oleh, Floating Market Lembang menjadi ikon wisata modern yang tetap mempertahankan sentuhan tradisional Sunda. Tempat ini tidak hanya menghadirkan pengalaman kuliner di atas air, tetapi juga mengajarkan pentingnya menghargai alam, budaya, dan kebersamaan — menjadikannya salah satu destinasi wisata terbaik yang wajib dikunjungi saat berlibur ke Bandung dan sekitarnya.', 'destinations/image/EpqU8kp68a7ClpZ9Iyki9GB6eJXdzm4oxwUbpdnP.jpg', 'destinations/thumbnailImage/w422Ql7Bz1AOWt0LA5RIgOjDeLd5RI6rfSjUu7C6.jpg', 'ctg005', 'adm001', NULL),
('dst014', 'Pura Tanah Lot', 'Tabanan, Bali', '06:00:00', '19:00:00', 'WITA', 'Senin', 'Minggu', 30000, 'Pura Tanah Lot adalah salah satu ikon wisata paling terkenal di Pulau Bali dan menjadi simbol keindahan serta kekayaan budaya spiritual masyarakat Hindu Bali. Terletak di Desa Beraban, Kecamatan Kediri, Kabupaten Tabanan, sekitar 20 kilometer dari Kota Denpasar, Pura Tanah Lot berdiri megah di atas batu karang besar di tengah laut yang hanya dapat diakses ketika air laut surut. Nama “Tanah Lot” berasal dari kata “tanah” yang berarti daratan dan “lot” atau “lod” yang berarti laut, yang secara harfiah menggambarkan lokasinya sebagai “daratan di tengah laut.” Pura ini dibangun pada abad ke-16 oleh Dang Hyang Nirartha, seorang pendeta suci dari Majapahit yang menyebarkan ajaran Hindu di Bali. Ia memilih lokasi ini karena keindahan dan kekuatan spiritualnya, lalu mendirikan pura sebagai tempat pemujaan dewa laut atau Dewa Baruna. Hingga kini, Pura Tanah Lot tetap menjadi salah satu pura laut (sad kahyangan) yang menjaga keseimbangan spiritual di Pulau Bali. Pemandangan di sekitar pura ini sangat menakjubkan, terutama saat matahari terbenam, ketika siluet pura berpadu dengan cahaya jingga keemasan langit, menciptakan panorama yang ikonik dan romantis. Setiap harinya, ribuan wisatawan datang untuk menyaksikan keindahan alamnya, berfoto, sekaligus merasakan suasana sakral yang menyelimuti kawasan pura.\r\n\r\n    Selain sebagai tempat suci, Pura Tanah Lot juga menjadi simbol keharmonisan antara alam, budaya, dan spiritualitas yang menjadi ciri khas Bali. Di sekitar area pura, terdapat gua ular suci (Pura Batu Bolong) yang diyakini menjaga kesucian pura dari roh jahat serta berbagai fasilitas wisata seperti taman, area belanja suvenir, restoran, dan tempat istirahat yang tertata rapi tanpa mengganggu keaslian lingkungan. Wisatawan dapat menikmati panorama laut lepas, menyaksikan upacara keagamaan, atau sekadar berjalan di sepanjang tebing yang menghadap ke Samudra Hindia. Kawasan ini dikelola dengan baik untuk tetap menjaga kesucian pura sambil memberikan pengalaman berwisata yang nyaman bagi pengunjung. Saat upacara keagamaan berlangsung, suasana Tanah Lot berubah menjadi sangat khusyuk dan sakral, dihiasi sesajen, dupa, dan gamelan Bali yang berpadu dengan deburan ombak — menghadirkan pengalaman spiritual yang mendalam. Keindahan alam, nilai sejarah, serta makna spiritual yang terkandung di dalamnya menjadikan Pura Tanah Lot bukan sekadar destinasi wisata, tetapi juga simbol warisan budaya Bali yang mendunia. Setiap sudutnya mengajarkan tentang keseimbangan hidup antara manusia, alam, dan Tuhan konsep yang dikenal sebagai Tri Hita Karana, yang menjadi filosofi utama kehidupan masyarakat Bali. Dengan segala pesona dan maknanya, Pura Tanah Lot benar-benar layak disebut sebagai permata spiritual di tepi Samudra Hindia yang tidak hanya memanjakan mata, tetapi juga menyentuh jiwa setiap pengunjungnya.', 'destinations/image/rz8lBEboJwppwDyvQ3mEsopp6WEaJZGgIWXXZB0B.jpg', 'destinations/thumbnailImage/NgU9JGjROBpJ6RURuDBLfiE3wcAmYpsjj0Pio8D4.jpg', 'ctg005', 'adm001', NULL),
('dst015', 'Kampung Cina Jakarta', 'Cibubur, Jakarta Timur, DKI Jakarta', '09:00:00', '18:00:00', 'WIB', 'Senin', 'Minggu', 25000, 'Kampung Cina Jakarta adalah salah satu kawasan wisata tematik yang menghadirkan suasana khas negeri Tiongkok di tengah hiruk-pikuk ibu kota Indonesia. Terletak di perumahan Kota Wisata, Cibubur, Jakarta Timur, kawasan ini dikenal sebagai destinasi wisata budaya dan kuliner yang menampilkan arsitektur oriental yang memukau serta suasana yang kental dengan nuansa tradisional Tionghoa. Didirikan pada awal tahun 2000-an, Kampung Cina dibangun dengan konsep miniatur kota bergaya oriental yang memadukan keindahan arsitektur klasik Tiongkok, ornamen merah keemasan, lampion gantung, hingga jembatan melengkung di atas danau buatan yang indah. Saat memasuki area ini, pengunjung seolah dibawa ke suasana kota-kota tua di China seperti Beijing atau Shanghai versi klasik. Deretan pertokoan dengan desain khas oriental menawarkan berbagai produk mulai dari suvenir, pakaian, hingga pernak-pernik khas Imlek. Di sepanjang jalan, tersedia pula banyak kios kuliner yang menjajakan makanan khas Tionghoa seperti bakpao, dimsum, mie ayam, hingga minuman herbal tradisional. Semua ini berpadu menciptakan pengalaman wisata yang unik, menyenangkan, sekaligus edukatif mengenai akulturasi budaya Tionghoa di Indonesia.\r\n\r\n    Selain menjadi tempat wisata tematik, Kampung Cina Jakarta juga berfungsi sebagai pusat budaya dan tempat rekreasi keluarga. Kawasan ini sering menjadi lokasi perayaan Imlek, Cap Go Meh, dan festival budaya Tionghoa lainnya yang menampilkan pertunjukan barongsai, wushu, musik tradisional, hingga parade lampion. Pengunjung tidak hanya dapat berbelanja dan bersantai, tetapi juga belajar mengenal lebih dekat tentang sejarah serta nilai-nilai budaya Tionghoa yang telah menjadi bagian penting dari keberagaman Jakarta. Fasilitas di kawasan ini cukup lengkap, mulai dari area parkir luas, tempat ibadah, taman bermain anak, hingga spot foto tematik yang instagramable. Selain itu, suasana malam hari di Kampung Cina juga sangat memikat, dengan gemerlap lampion merah yang memantulkan cahaya di permukaan air dan menciptakan nuansa romantis yang cocok untuk pasangan maupun keluarga. Lokasinya yang strategis — hanya sekitar 30 menit dari pusat Kota Jakarta — menjadikannya salah satu destinasi favorit warga ibu kota untuk rekreasi singkat di akhir pekan. Lebih dari sekadar tempat wisata, Kampung Cina Jakarta juga menjadi simbol kerukunan dan keberagaman budaya Indonesia, di mana pengunjung dari berbagai latar belakang dapat berkumpul, menikmati kuliner, serta menghargai warisan budaya yang indah dan penuh warna. Dengan keunikan konsepnya yang memadukan budaya, hiburan, dan edukasi, Kampung Cina Jakarta layak disebut sebagai “miniatur Tiongkok di jantung ibu kota” yang memikat hati setiap pengunjungnya.', 'destinations/image/XsvCTjWGMvS5CPrT6QMOZBmKZMIOgkO1KpV8Ga7C.jpg', 'destinations/thumbnailImage/J5kk3yPWr4THwVkGWftebT7nMKgbSRbwVDEzDPD8.jpg', 'ctg005', 'adm001', NULL);
INSERT INTO `destination` (`destinationID`, `name`, `location`, `openingHours`, `closingHours`, `timezone`, `openingDay`, `closingDay`, `entranceFee`, `description`, `imagePath`, `thumbnailImagePath`, `destCategoryID`, `adminID`, `deleted_at`) VALUES
('dst016', 'Taman Ismail Marzuki', 'Cikini, Jakarta Pusat, DKI Jakarta', '09:00:00', '21:00:00', 'WIB', 'Senin', 'Minggu', 0, 'Taman Ismail Marzuki (TIM) adalah pusat seni dan kebudayaan ternama yang terletak di Jalan Cikini Raya No. 73, Jakarta Pusat, dan menjadi salah satu ikon penting dalam perkembangan dunia seni Indonesia. Diresmikan pada 10 November 1968, taman budaya ini dinamai untuk mengenang Ismail Marzuki, komponis besar Indonesia yang telah menciptakan ratusan lagu perjuangan dan nasional yang melegenda, seperti Rayuan Pulau Kelapa dan Halo-Halo Bandung. Sejak berdirinya, TIM telah menjadi wadah ekspresi dan kreativitas seniman dari berbagai bidang — mulai dari seni pertunjukan, musik, tari, teater, film, hingga seni rupa. Kawasan ini dulunya merupakan lokasi Kebun Binatang Cikini sebelum kemudian dialihfungsikan menjadi kompleks seni. Kini, setelah proses revitalisasi besar-besaran yang rampung pada tahun 2022, Taman Ismail Marzuki tampil dengan wajah baru yang lebih modern namun tetap mempertahankan ruh kebudayaan yang kuat. Di dalamnya terdapat berbagai fasilitas seni kelas dunia seperti Graha Bhakti Budaya (gedung pertunjukan utama), Galeri Cipta, Teater Jakarta, Perpustakaan Jakarta, Planetarium Jakarta, serta Pusat Dokumentasi Sastra HB Jassin, yang menjadi pusat literasi dan arsip kesusastraan terbesar di Indonesia. Semua fasilitas ini dirancang untuk mendukung seniman, pelajar, hingga masyarakat umum agar dapat menikmati dan mengembangkan seni serta budaya Indonesia secara lebih luas.\r\n\r\n    Lebih dari sekadar tempat pertunjukan, Taman Ismail Marzuki adalah simbol kehidupan budaya urban yang dinamis dan inklusif di Jakarta. Setiap minggu, TIM menjadi tempat digelarnya berbagai acara seperti pementasan teater modern dan tradisional, konser musik, pemutaran film independen, pameran seni rupa, diskusi sastra, hingga festival kebudayaan nasional dan internasional. Suasana di kawasan ini sangat hidup, terutama di malam hari ketika gedung-gedungnya diterangi cahaya lampu yang menambah kesan artistik. Pengunjung dapat berjalan santai di area plaza terbuka sambil menikmati karya instalasi publik atau bersantai di kafe dan ruang kreatif yang tersebar di sekitar kompleks. Revitalisasi TIM juga menghadirkan konsep “Pusat Seni dan Literasi Modern”, di mana teknologi, seni, dan budaya berpadu dalam ruang yang ramah bagi semua kalangan, mulai dari pelajar hingga seniman profesional. Lokasinya yang strategis di pusat kota membuat TIM mudah diakses dengan berbagai moda transportasi publik, seperti TransJakarta dan MRT. Sebagai ikon kebudayaan Jakarta dan Indonesia, Taman Ismail Marzuki bukan hanya tempat untuk menonton seni, tetapi juga ruang untuk menyatu, berdialog, dan berkreasi bersama melalui bahasa universal seni. Dengan nilai sejarah, peran edukatif, dan kontribusinya terhadap dunia budaya nasional, TIM layak disebut sebagai jantung seni Indonesia — tempat di mana ide, ekspresi, dan imajinasi berkembang tanpa batas di tengah denyut kehidupan metropolitan.', 'destinations/image/n9e7PuYSxMelsAEIKTAZtnbY6lBZhk79EIAhYaUh.jpg', 'destinations/thumbnailImage/WBYNzgEkEzKPGnowwduq3rU8AoCccA3RENUAzY7t.jpg', 'ctg006', 'adm001', NULL),
('dst017', 'Taman Mini Indonesia Indah', 'Jakarta Timur, DKI Jakarta', '07:00:00', '17:00:00', 'WIB', 'Senin', 'Minggu', 25000, 'Taman Mini Indonesia Indah (TMII) adalah salah satu destinasi wisata budaya dan edukasi paling ikonik di Indonesia, terletak di Jakarta Timur, di atas lahan seluas sekitar 150 hektare. Diresmikan pada tahun 1975 oleh Ibu Tien Soeharto, TMII dibangun dengan tujuan memperkenalkan dan melestarikan keberagaman budaya, adat, serta kekayaan alam Indonesia dalam satu kawasan miniatur yang indah. Konsep utama Taman Mini Indonesia Indah adalah menghadirkan gambaran lengkap tentang Indonesia dari Sabang hingga Merauke, melalui replika rumah adat, pakaian tradisional, seni pertunjukan, hingga keragaman bahasa dan tradisi dari 38 provinsi di Tanah Air. Di kawasan ini terdapat Anjungan Daerah yang menampilkan arsitektur khas masing-masing provinsi lengkap dengan artefak, kerajinan tangan, dan pertunjukan seni tradisionalnya. Selain itu, TMII juga memiliki berbagai wahana edukatif seperti Museum Indonesia, Museum Transportasi, Museum Komodo, Museum Listrik dan Energi Baru, hingga Taman Burung dan Dunia Air Tawar. Salah satu daya tarik utamanya adalah danau miniatur Indonesia, yang menggambarkan kepulauan Nusantara dalam bentuk tiga dimensi, terlihat paling indah dari ketinggian melalui wahana kereta gantung (sky lift) yang memungkinkan pengunjung menikmati panorama taman dari udara.\r\n\r\nLebih dari sekadar tempat wisata, Taman Mini Indonesia Indah merupakan pusat pelestarian budaya dan pendidikan karakter bangsa. Di sini, pengunjung tidak hanya dapat berekreasi, tetapi juga belajar memahami betapa luas dan beragamnya warisan budaya Indonesia. TMII juga menjadi lokasi penyelenggaraan berbagai acara budaya, festival daerah, dan perayaan nasional seperti Hari Kemerdekaan, Pekan Budaya Nusantara, dan Festival Kesenian Tradisional. Suasana taman yang hijau dengan pepohonan rindang, taman bunga, serta area bermain keluarga menjadikannya tempat yang ideal untuk rekreasi sekaligus edukasi Dalam beberapa tahun terakhir, TMII mengalami revitalisasi besar-besaran untuk menghadirkan wajah baru yang lebih modern namun tetap mempertahankan nilai-nilai kebangsaan dan tradisi. Kini, pengunjung dapat menikmati fasilitas modern seperti area digital interaktif, amfiteater budaya, restoran tematik, serta sarana transportasi ramah lingkungan yang memudahkan eksplorasi kawasan. Dengan konsep yang terus berkembang, TMII bukan hanya menjadi ikon wisata Jakarta, tetapi juga simbol persatuan dan kebanggaan bangsa Indonesia, yang menegaskan semboyan “Bhinneka Tunggal Ika” — berbeda-beda tetapi tetap satu jua. Mengunjungi TMII berarti menjelajahi miniatur Indonesia yang sesungguhnya, di mana setiap sudutnya menggambarkan keindahan, keberagaman, dan semangat persaudaraan yang menjadi jati diri bangsa.', 'destinations/image/3QYI1OL5f7PODfNGs0RPxjVMjr6oPydlI1XA9Tua.jpg', 'destinations/thumbnailImage/CBRkIdizkkgWiw8aU0o9hU8onrHjiLRM7jI8IYa3.jpg', 'ctg006', 'adm001', NULL),
('dst018', 'Museum Pengkhianatan Partai Komunis Indonesia (PKI)', 'Lubang Buaya, Jakarta Timur, DKI Jakarta', '08:00:00', '16:00:00', 'WIB', 'Senin', 'Minggu', 10000, 'Museum Pengkhianatan PKI atau dikenal juga sebagai Museum Pengkhianatan Partai Komunis Indonesia (PKI) adalah salah satu museum bersejarah yang terletak di Kompleks Monumen Pancasila Sakti, Lubang Buaya, Jakarta Timur. Museum ini dibangun untuk mengenang peristiwa kelam Gerakan 30 September 1965 (G30S/PKI), yaitu usaha kudeta yang dilakukan oleh Partai Komunis Indonesia terhadap pemerintahan Republik Indonesia. Diresmikan pada tahun 1992, museum ini menjadi saksi sejarah sekaligus sarana edukasi bagi masyarakat tentang pentingnya menjaga keutuhan bangsa dan ideologi Pancasila. Bangunan museum berdiri megah di kawasan yang juga menjadi lokasi ditemukannya Lubang Buaya, tempat di mana tujuh perwira tinggi TNI Angkatan Darat menjadi korban penculikan dan pembunuhan. Di dalamnya terdapat ruang diorama, galeri foto, artefak, dan dokumentasi sejarah yang menggambarkan secara kronologis perkembangan ideologi komunisme di Indonesia, aksi-aksi pemberontakan PKI sejak 1948 di Madiun hingga peristiwa G30S 1965. Pengunjung dapat melihat 35 diorama yang disusun berurutan, menampilkan berbagai peristiwa penting seperti penculikan para jenderal, pembunuhan di Lubang Buaya, serta proses penumpasan gerakan tersebut oleh rakyat dan pemerintah Indonesia. Selain diorama, museum ini juga menyimpan koleksi benda-benda bersejarah seperti pakaian korban, dokumen propaganda, foto pelaku, serta berbagai senjata dan perlengkapan yang digunakan pada masa itu.\r\n\r\nLebih dari sekadar tempat penyimpanan benda sejarah, Museum Pengkhianatan PKI berfungsi sebagai pengingat dan pelajaran moral bagi generasi penerus bangsa tentang bahaya ideologi yang bertentangan dengan nilai-nilai Pancasila. Melalui berbagai koleksinya, museum ini berusaha menanamkan kesadaran nasionalisme dan semangat cinta tanah air agar peristiwa serupa tidak terulang kembali. Setiap sudut ruangan dirancang dengan narasi yang kuat untuk mengajak pengunjung memahami konteks sejarah secara mendalam — mulai dari latar belakang munculnya PKI, metode perekrutan dan penyebaran ideologi, hingga dampak sosial dan politik yang ditimbulkan. Tak jauh dari bangunan utama, terdapat pula Monumen Pancasila Sakti, Rumah Penyiksaan, Sumur Lubang Buaya, serta patung tujuh pahlawan revolusi yang gugur pada peristiwa tersebut, menjadikan kawasan ini sebagai kompleks peringatan sejarah yang lengkap. Museum ini sering menjadi tujuan kunjungan sekolah, instansi pemerintah, dan wisatawan lokal yang ingin memahami perjalanan bangsa Indonesia dalam mempertahankan ideologi dan kedaulatan negara. Dengan perpaduan antara nilai sejarah, nasionalisme, dan edukasi, Museum Pengkhianatan PKI bukan hanya tempat mengenang masa lalu, tetapi juga ruang pembelajaran tentang pentingnya menjaga persatuan, menolak paham radikal, serta meneguhkan semangat kebangsaan Indonesia yang berlandaskan Pancasila.', 'destinations/image/fJn0FmdfucsZlZtjg17yJQZ3Ija2INERmSeohNDB.jpg', 'destinations/thumbnailImage/LBGwYG2UoN27KMCTkwuXR0F6k7ER0Z2cfnCgS7Zg.jpg', 'ctg006', 'adm001', NULL),
('dst019', 'tes', 'tes', '09:00:00', '10:00:00', 'WIB', 'senin', 'selasa', 10, 'ttsts', 'destinations/image/cj91trVvfno15Wdtfjxwd0BRYu1myosHtEoxA4BC.png', 'destinations/thumbnailImage/O0qyqDKa3iwSitoEf5oLmTeVooxAfH3XCzFZ5IUe.png', 'ctg001', 'adm001', '2026-05-26 08:47:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `eventID` varchar(6) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quota` int NOT NULL DEFAULT '100000',
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `entranceFee` int NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `socialMedia` varchar(50) NOT NULL,
  `imagePath` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `destinationID` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `adminID` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`eventID`, `name`, `quota`, `startDate`, `endDate`, `location`, `description`, `entranceFee`, `startTime`, `endTime`, `socialMedia`, `imagePath`, `destinationID`, `adminID`, `deleted_at`) VALUES
('evt001', 'SAMBUT ENERGI POSITIF DI TENGAH KEAGUNGAN CANDI BOROBUDUR', 99999, '2025-08-22', '2025-12-28', 'Borobudur Cultural Center, Candi Borobudur', 'Ruang penyembuhan dan ketenangan yang memanfaatkan suasana spiritual Candi Borobudur yang sakral. \"Samadha\" (Samadhi) merupakan istilah dalam praktik meditasi yang merujuk pada kondisi konsentrasi penuh dan ketenangan mendalam, sementara Pranic Healing adalah teknik penyembuhan yang menggunakan energi prana atau energi vital. Acara ini bukan sekadar meditasi biasa, melainkan penggabungan ilmu pranic healing dengan teknik meditasi, bertujuan untuk melepaskan stres, mengembalikan keseimbangan tubuh, serta mengisi diri dengan energi positif yang berlimpah dari lingkungan Borobudur. Program ini sangat ideal bagi mereka yang mencari pengalaman wisata wellness dan spiritual.', 100, '09:00:00', '15:00:00', 'borobudurculturalcenter', 'events/z2rXQT6K6lTGH70YUI6zwKNnFzR6WWao1LRgv1fU.jpg', 'dst004', 'adm001', NULL),
('evt002', 'SENDRATARI RAMAYANA PRAMBANAN', 99997, '2025-11-01', '2025-12-31', 'Gedung Trimurti, Candi Prambanan', 'Persembahan budaya yang megah, Sendratari Ramayana Prambanan adalah sebuah mahakarya yang menawan. Di tengah keagungan Candi Prambanan yang spiritual, epos kuno Ramayana dihidupkan kembali melalui tarian gemulai, drama yang kuat, dan iringan gamelan yang syahdu. Pertunjukan ini bukan sekadar tontonan, melainkan pengalaman mendalam yang menghubungkan penonton dengan warisan budaya luhur Jawa. Pada periode akhir tahun ini, suasana hangat Gedung Trimurti (panggung tetutup) akan menjadi saksi bisu keindahan abadi kisah Rama dan Shinta.', 150000, '19:30:00', '21:00:00', 'prambananpark', 'events/NemigAYqbj0Ie9Sk2ygu8sw6gONsz8ruWLyGodJW.jpg', 'dst005', 'adm001', NULL),
('evt003', 'SORAK SORAI FEST 2026', 99997, '2025-12-29', '2025-12-31', 'Taman Mini Indonesia Indah', 'Sorak Sorai Fest adalah sebuah festival akhir tahun yang menggabungkan konser musik, festival kuliner, dan berbagai kegiatan menarik lainnya. Festival ini biasanya berlangsung di Taman Mini Indonesia Indah (TMII) saat pergantian tahun, menawarkan hiburan untuk pengunjung dari berbagai kalangan. Festival yang biasanya diselenggarakan di Taman Mini Indonesia Indah (TMII) menjelang pergantian tahun. Dengan konsep hiburan keluarga dan pesta rakyat, Sorak Sorai Fest menjadi salah satu agenda tahunan yang paling dinanti oleh masyarakat Jakarta untuk merayakan malam tahun baru dalam suasana penuh warna dan kebersamaan.', 100000, '17:00:00', '23:00:00', 'soraksoraifest', 'events/PMwiAL85B8JFoBeZmh8FwuriBxkX8JCA5kPLymnR.jpg', 'dst017', 'adm001', NULL),
('evt004', 'tes', 100000, '2026-05-01', '2026-05-02', 'tes', 'tes', 10, '09:00:00', '12:00:00', 'tes', 'events/Kab0x59zlqw2SwUSQ8PTudFoXohg0q77WQmlaXz9.jpg', NULL, 'adm002', '2026-05-17 08:10:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(5, '2026_06_06_161136_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `orderID` varchar(6) NOT NULL,
  `orderDate` timestamp NOT NULL,
  `userID` varchar(6) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`orderID`, `orderDate`, `userID`, `totalPrice`) VALUES
('OD2QZP', '2026-05-20 18:11:05', 'usr002', 100000.00),
('OD2RLE', '2026-05-20 11:21:00', 'usr007', 150000.00),
('OD5SFG', '2026-06-20 19:17:34', 'usr003', 150000.00),
('OD85LH', '2026-06-07 18:16:34', 'usr001', 150000.00),
('ODAIMH', '2026-05-20 18:11:05', 'usr001', 200.00),
('ODCXVQ', '2026-06-05 15:53:02', 'usr001', 100000.00),
('ODDAAX', '2026-06-20 19:16:59', 'usr003', 100.00),
('ODDABM', '2026-06-08 08:46:19', 'usr001', 100.00),
('ODGRZU', '2026-05-20 18:27:17', 'usr006', 100.00),
('ODKLGF', '2026-05-23 05:03:40', 'usr001', 100000.00),
('ODLNXP', '2026-06-05 15:52:38', 'usr001', 100000.00),
('ODMRL8', '2026-06-08 08:38:08', 'usr005', 100000.00),
('ODQDQK', '2026-05-31 05:48:14', 'usr004', 150000.00),
('ODUSLP', '2026-05-20 18:11:05', 'usr001', 100000.00),
('ODVMJL', '2026-05-20 11:18:49', 'usr007', 100000.00),
('ODVVMK', '2026-05-20 11:12:01', 'usr003', 100000.00),
('ODZ969', '2026-05-31 04:34:28', 'usr005', 150000.00),
('ODZPYR', '2026-05-20 18:11:05', 'usr001', 300000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `paymentID` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `paymentDate` date NOT NULL,
  `paymentStatus` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `orderID` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`paymentID`, `paymentDate`, `paymentStatus`, `orderID`) VALUES
('PY18H0', '2026-05-31', 'pending', 'ODZ969'),
('PY39BZ', '2026-05-20', 'success', 'OD2RLE'),
('PY6BNA', '2026-06-08', 'success', 'ODDABM'),
('PYAHHM', '2026-05-20', 'success', 'OD2QZP'),
('PYARZX', '2026-05-23', 'success', 'ODKLGF'),
('PYBKQI', '2026-05-20', 'success', 'ODUSLP'),
('PYBOLL', '2026-06-21', 'pending', 'OD5SFG'),
('PYFM1B', '2026-06-05', 'pending', 'ODCXVQ'),
('PYJ7VI', '2026-05-21', 'success', 'ODGRZU'),
('PYMUVS', '2026-06-21', 'cancelled', 'ODDAAX'),
('PYOOCH', '2026-06-08', 'success', 'ODMRL8'),
('PYPERS', '2026-06-05', 'pending', 'ODLNXP'),
('PYPRNU', '2026-05-20', 'pending', 'ODZPYR'),
('PYPUAC', '2026-05-17', 'pending', 'ODAIMH'),
('PYSQBM', '2026-05-31', 'pending', 'ODQDQK'),
('PYTLDH', '2026-06-08', 'pending', 'OD85LH'),
('PYUAXR', '2026-05-20', 'pending', 'ODVMJL'),
('PYWPNV', '2026-05-20', 'success', 'ODVVMK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'e8aedec9d396ad782604f62c8b823842b771aca08fe91e8ba89ca2ad7306d955', '[\"*\"]', NULL, NULL, '2026-06-06 09:37:50', '2026-06-06 09:37:50'),
(2, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'd6da9f5da4dde771ed67ad57c00f7220615be9924ef5b1349b571ec1d9870ca4', '[\"*\"]', NULL, NULL, '2026-06-06 09:56:27', '2026-06-06 09:56:27'),
(3, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '44887d790c77fe14b4a661c880a10ed663f1c48a72355cbc16348fe895084d77', '[\"*\"]', NULL, NULL, '2026-06-06 10:21:06', '2026-06-06 10:21:06'),
(4, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '8b817003504c01cdacfa489a863a9ce4d93484495b9434b19316e7da61513901', '[\"*\"]', NULL, NULL, '2026-06-06 10:23:53', '2026-06-06 10:23:53'),
(5, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'df97ee1c32a7a93b8879f6a1f07e9ef2add381feb291c3000f6e722b9bf0d58e', '[\"*\"]', NULL, NULL, '2026-06-06 10:24:50', '2026-06-06 10:24:50'),
(6, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '40da6756a1373b802f9fed1046a5c223c0241e14e6720e5a7d08bf2fd88f6037', '[\"*\"]', NULL, NULL, '2026-06-06 10:27:52', '2026-06-06 10:27:52'),
(7, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'd6b5af92a4d2122ebcd691344e2a49ae9afd911867769d75438ffa7c7ae8fbd4', '[\"*\"]', NULL, NULL, '2026-06-06 10:35:31', '2026-06-06 10:35:31'),
(8, 'App\\Models\\UserBiasa', 'usr004', 'auth_token', 'f123944f5ab64f5b5e254ebbf87957bcdd59614ac656c553a147f68c67376795', '[\"*\"]', NULL, NULL, '2026-06-06 10:39:08', '2026-06-06 10:39:08'),
(9, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'ee63eeb11a5815447ea510369904e6452ee4ad1c6b5208e13de659884b2117e3', '[\"*\"]', NULL, NULL, '2026-06-06 14:14:32', '2026-06-06 14:14:32'),
(10, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '07257120b3013e42a47033993b3daf6408205e13123c0afd8c93700160c7edf6', '[\"*\"]', NULL, NULL, '2026-06-06 14:18:25', '2026-06-06 14:18:25'),
(11, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'b053e5f0e90af34f728326a08a0bb6811c239718cba9223492ac20e2015c4dd6', '[\"*\"]', NULL, NULL, '2026-06-06 14:20:52', '2026-06-06 14:20:52'),
(12, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'b2f05a973febae107f397345c86333fe5c9fa6d7c16bd3dbd6176340af5e5c85', '[\"*\"]', NULL, NULL, '2026-06-06 19:11:39', '2026-06-06 19:11:39'),
(13, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'c8667194d31a720c6bc6cd13f91a27d393deb424a02f0b638577475fcfd9c861', '[\"*\"]', NULL, NULL, '2026-06-06 19:21:22', '2026-06-06 19:21:22'),
(14, 'App\\Models\\UserBiasa', 'usr004', 'auth_token', '08a184e234f1147de3f03259ec5e3f43ac73fb707e55c654ccaf1e96a0a71cca', '[\"*\"]', '2026-06-06 19:46:00', NULL, '2026-06-06 19:27:22', '2026-06-06 19:46:00'),
(15, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '2ae4a565dfd529b088d55ac9069b8df3c3ae49bcdef23592faf1d3f4995a04eb', '[\"*\"]', '2026-06-07 10:08:29', NULL, '2026-06-06 19:37:49', '2026-06-07 10:08:29'),
(16, 'App\\Models\\UserBiasa', 'usr004', 'auth_token', '53e21ccc05efca0583fffc988809f0643c6b9c878f67718237f7896e45cd6b9f', '[\"*\"]', '2026-06-06 19:56:07', NULL, '2026-06-06 19:56:05', '2026-06-06 19:56:07'),
(17, 'App\\Models\\UserBiasa', 'usr004', 'auth_token', '3d07621d568a73287d65e4d5db80e3d416a844456ec0a672cba68125e1de06be', '[\"*\"]', '2026-06-06 20:07:39', NULL, '2026-06-06 19:57:31', '2026-06-06 20:07:39'),
(18, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'fdc0f6b16d7cc2c0a6e6b3f278961c0ac4aba5b55643cf128a4788a0d4bc6ccc', '[\"*\"]', '2026-06-06 20:14:27', NULL, '2026-06-06 20:14:12', '2026-06-06 20:14:27'),
(19, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '6b34e5083c21c49de06f57c3287fda65274702cc54ac6d1a764ee78f431c1d09', '[\"*\"]', '2026-06-06 20:53:13', NULL, '2026-06-06 20:49:08', '2026-06-06 20:53:13'),
(20, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'c4d953e1521c8919a679f6a578db5306feb15a824c3d3d33113407fd95dd1e56', '[\"*\"]', '2026-06-06 21:04:21', NULL, '2026-06-06 21:03:19', '2026-06-06 21:04:21'),
(21, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'b8b1a0ba5d2ae02d0097e72092e8ab47880d5c8e5c6598232a05353d428cd928', '[\"*\"]', '2026-06-06 21:11:17', NULL, '2026-06-06 21:10:45', '2026-06-06 21:11:17'),
(22, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'ea916841169b81ee1027ce8f70e88295a38dfe0ed768e1d3809f170194e21dcd', '[\"*\"]', '2026-06-06 21:16:35', NULL, '2026-06-06 21:16:32', '2026-06-06 21:16:35'),
(23, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '35940147387283df948a6023d53465cb9db72079ed4c350fd0d2419f0027f584', '[\"*\"]', '2026-06-07 08:38:37', NULL, '2026-06-07 08:38:21', '2026-06-07 08:38:37'),
(24, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '33d01968478ac3bd8b27785e33c4fd95fa3b2caacecc9075321c868dbf8a445b', '[\"*\"]', '2026-06-07 08:52:06', NULL, '2026-06-07 08:44:02', '2026-06-07 08:52:06'),
(25, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '6c797d1978112d2afe2bf8af98af6e4d9281d119f7b650f7f4ca0404c9c1f37e', '[\"*\"]', '2026-06-07 09:51:29', NULL, '2026-06-07 09:51:23', '2026-06-07 09:51:29'),
(26, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'c8b3a5a3309213791391c4f668cdfd5eb320e3d95b49d644fde6f93bb0a5fa7c', '[\"*\"]', '2026-06-07 09:58:42', NULL, '2026-06-07 09:58:40', '2026-06-07 09:58:42'),
(27, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '2cb4a32950c5ba2c4e4fe2776af5b8a3a4c5d558d7f42d13e50e57f9851eb213', '[\"*\"]', '2026-06-07 10:05:40', NULL, '2026-06-07 10:05:37', '2026-06-07 10:05:40'),
(28, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'dc07ee6a7b196f12553092432f0fe8e00edbfc2338cb732a0a19a465bb607d98', '[\"*\"]', '2026-06-07 10:26:46', NULL, '2026-06-07 10:26:40', '2026-06-07 10:26:46'),
(29, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '3dec0d3cd61481b107dbff7c58d75cec42b9c8a9418fc80b6f49e0cd992bc27e', '[\"*\"]', '2026-06-07 10:31:07', NULL, '2026-06-07 10:30:23', '2026-06-07 10:31:07'),
(30, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '09d9058b43ef871c2c04757e35baed14798e40347a6d6634bfddde26c3fe76ad', '[\"*\"]', '2026-06-07 10:34:21', NULL, '2026-06-07 10:34:17', '2026-06-07 10:34:21'),
(31, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '0c0bf992c968286b837e86d326870b66600fc4d9ae76ad908940a72f91a7a823', '[\"*\"]', '2026-06-07 10:46:41', NULL, '2026-06-07 10:41:58', '2026-06-07 10:46:41'),
(32, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'b8e313678385dd348e7fb85e524ca50664536b115e26d1349a65b951accbd0d2', '[\"*\"]', '2026-06-07 18:04:43', NULL, '2026-06-07 10:55:48', '2026-06-07 18:04:43'),
(33, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '6602bfa8e78d455a7e2d0ac8e0e6983bae5dda01ed2ebfd0f45be076c0099553', '[\"*\"]', '2026-06-07 11:03:41', NULL, '2026-06-07 11:02:57', '2026-06-07 11:03:41'),
(34, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'f688068477b3f758de5e12860ed6b3ee35a4f59d50fcbb5edd439a28a192f74a', '[\"*\"]', '2026-06-07 11:09:35', NULL, '2026-06-07 11:09:22', '2026-06-07 11:09:35'),
(35, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'd473fd801ab50145e5bfbb1734704b7a4044263c36f18190446510298010895e', '[\"*\"]', '2026-06-07 11:14:50', NULL, '2026-06-07 11:14:44', '2026-06-07 11:14:50'),
(36, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '29746395ea3ae00be618885420bfa138eddb667399685691cd3460630de39603', '[\"*\"]', '2026-06-07 11:17:54', NULL, '2026-06-07 11:17:50', '2026-06-07 11:17:54'),
(37, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '078c2863cd98b7e83fa3bf4c1a077c1496322b1a8c189fb3b1ea7756d212e089', '[\"*\"]', '2026-06-07 11:24:37', NULL, '2026-06-07 11:21:35', '2026-06-07 11:24:37'),
(38, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '4bf8f2a93546250adef235188cadfb4d7cf913db655255f17533dec1d1042f76', '[\"*\"]', '2026-06-07 11:41:57', NULL, '2026-06-07 11:38:13', '2026-06-07 11:41:57'),
(39, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '43996a4a33b0b121b26bc48b717450bf47022ca4de07cfc7254e015f2d62b535', '[\"*\"]', '2026-06-07 14:14:03', NULL, '2026-06-07 14:13:47', '2026-06-07 14:14:03'),
(40, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '4842421247ac4fc3886187798b16a9536f13f12405233284a7adfa410bf704ef', '[\"*\"]', '2026-06-07 14:17:18', NULL, '2026-06-07 14:16:37', '2026-06-07 14:17:18'),
(41, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'b069f890fca7be9213dfb2951deaf7b29451f51032ec41ef5fffe8d24d5f4c11', '[\"*\"]', '2026-06-07 14:24:59', NULL, '2026-06-07 14:20:14', '2026-06-07 14:24:59'),
(42, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'bd0a4fb5667665dd6f8a27b5b854d287e1816c9cf3764c9612f5e7ffc3e146d2', '[\"*\"]', '2026-06-07 14:27:47', NULL, '2026-06-07 14:27:21', '2026-06-07 14:27:47'),
(43, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '09812b0978f6ede9282bd70a21b53cc9b905f9d01bc61fcaf5f5592c237dbd69', '[\"*\"]', '2026-06-07 14:41:52', NULL, '2026-06-07 14:34:23', '2026-06-07 14:41:52'),
(44, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'f9c810328f7d35345d59b8e6ba1ecdac0f834e92c0951fc9ce1abd7f75750c87', '[\"*\"]', '2026-06-07 15:09:09', NULL, '2026-06-07 14:57:00', '2026-06-07 15:09:09'),
(45, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'e042acdfa74e207c51f5309f021b021659f896f3d869a80d064087b424f9be21', '[\"*\"]', '2026-06-07 15:10:02', NULL, '2026-06-07 15:09:48', '2026-06-07 15:10:02'),
(46, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '414c5c43cdcff81ca64f4dd4a83568bb3fc5a80de35f38220b1f08a771db1dff', '[\"*\"]', '2026-06-07 15:15:36', NULL, '2026-06-07 15:11:12', '2026-06-07 15:15:36'),
(47, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '4cf9c3a0b3672e912b5abdcffdbfeb6a8ee0de5d5683760c378bbb9c75e125b1', '[\"*\"]', '2026-06-07 15:21:47', NULL, '2026-06-07 15:18:00', '2026-06-07 15:21:47'),
(48, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '0f9b3b0a60c2e3a6649a60ab37f2e69a557541c4b77b1ec631727cb01dcd003f', '[\"*\"]', '2026-06-07 15:23:11', NULL, '2026-06-07 15:23:09', '2026-06-07 15:23:11'),
(49, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '59bbb611af1a98891ddc2f1adecd13e8e4e9cb88067af463f5bf24f3a5872cba', '[\"*\"]', '2026-06-07 15:24:22', NULL, '2026-06-07 15:23:49', '2026-06-07 15:24:22'),
(50, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '5067249948c2ba194e8adeb3bdde3ca59c284e140ac389b3c3a476afc21223a6', '[\"*\"]', '2026-06-07 15:25:01', NULL, '2026-06-07 15:24:43', '2026-06-07 15:25:01'),
(51, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'b892b36a1da2360b716a8ca178c06f92e5467f5c82602aa4df87d87973fda961', '[\"*\"]', '2026-06-07 15:26:11', NULL, '2026-06-07 15:25:57', '2026-06-07 15:26:11'),
(52, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '6ce2492e010a339ecb459a612afe384e7fc486e9d67266432b0af344c6e8cb2e', '[\"*\"]', '2026-06-07 15:30:27', NULL, '2026-06-07 15:28:30', '2026-06-07 15:30:27'),
(53, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '258f5d692a8d80935e382048dc6194f3a277210cf3dd5e129880003e2cd7185f', '[\"*\"]', '2026-06-07 15:51:46', NULL, '2026-06-07 15:51:20', '2026-06-07 15:51:46'),
(54, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'a569b3d98851f8377fb3946e09da96dd0e6c24a99a15eaf5a6e2958b7d7922b4', '[\"*\"]', '2026-06-07 16:03:34', NULL, '2026-06-07 16:03:31', '2026-06-07 16:03:34'),
(55, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'fd21df18cca86ed1edc88db96904b0b5cc7d0ad6e531dfdafa5f7d8129051535', '[\"*\"]', '2026-06-07 16:24:04', NULL, '2026-06-07 16:15:39', '2026-06-07 16:24:04'),
(56, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '015c834d9cb7373900b61facd8c79c51bf85293c16c0e8356b9ddce07cacfb7d', '[\"*\"]', '2026-06-07 16:39:08', NULL, '2026-06-07 16:25:04', '2026-06-07 16:39:08'),
(57, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '05fb6850fd3dd3130bb0af66b7044362841f20641f8fdd6126a539663897cfa2', '[\"*\"]', '2026-06-07 17:19:17', NULL, '2026-06-07 17:00:50', '2026-06-07 17:19:17'),
(58, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '6f6d00ec48d0512116d14bcbbe1b22e26bb40cd5c111c3b32f12ca91e3470454', '[\"*\"]', '2026-06-07 18:21:29', NULL, '2026-06-07 18:20:19', '2026-06-07 18:21:29'),
(59, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '84c7d9d1f7957a43a7aa4aef4baf7dd9e423ab776b5ec7cac98ce87cdc7c00f1', '[\"*\"]', '2026-06-07 18:24:40', NULL, '2026-06-07 18:24:31', '2026-06-07 18:24:40'),
(60, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', '7c25d5e51b57ebc4b22fdc204a4053a7ce05b9772a9e739a47bd97aac5bbf365', '[\"*\"]', '2026-06-08 07:50:34', NULL, '2026-06-08 07:49:01', '2026-06-08 07:50:34'),
(61, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '0d3df8ddc5fa16c22c72f5022e78d81f22fd634b3736bdfd0affa7a4f606c0f8', '[\"*\"]', '2026-06-08 07:51:07', NULL, '2026-06-08 07:50:54', '2026-06-08 07:51:07'),
(62, 'App\\Models\\UserBiasa', 'usr007', 'auth_token', '3a409998b2545c75a029f14ef43634a1885fde38ff34b35f4bbbad4a8140733f', '[\"*\"]', '2026-06-08 07:54:03', NULL, '2026-06-08 07:53:10', '2026-06-08 07:54:03'),
(63, 'App\\Models\\UserBiasa', 'usr007', 'auth_token', '680c80fc09c11f5c02b815189f0cfb7094b332e60cf2ea6e2132d2e92d8a67cc', '[\"*\"]', '2026-06-08 08:55:29', NULL, '2026-06-08 07:55:23', '2026-06-08 08:55:29'),
(64, 'App\\Models\\UserBiasa', 'usr001', 'auth_token', 'ab920f9c79900b3dbe6c2863f492176f0599e83763ab39e8143f2b797ff52453', '[\"*\"]', '2026-06-08 08:58:56', NULL, '2026-06-08 08:55:16', '2026-06-08 08:58:56'),
(65, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '53d480990805b596a10a612788d37c67916f0294d90cf429710c062db2492705', '[\"*\"]', '2026-06-18 13:35:49', NULL, '2026-06-18 13:33:15', '2026-06-18 13:35:49'),
(66, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', 'd175c86032c3136400cc5448cb37585c07d02f754d36f1e7abbf1f5ce590f59e', '[\"*\"]', '2026-06-19 08:25:30', NULL, '2026-06-19 08:25:09', '2026-06-19 08:25:30'),
(67, 'App\\Models\\UserBiasa', 'usr008', 'auth_token', '79b3323de9ff4272a2142e1e299a7b46349d9cf8d042850d4ba9a3432d9ba70d', '[\"*\"]', '2026-06-19 09:22:11', NULL, '2026-06-19 09:17:17', '2026-06-19 09:22:11'),
(68, 'App\\Models\\UserBiasa', 'usr008', 'auth_token', '721659dfd8ebab67d30f5848c78a5fb71d84abd73550409b4ae8bbdb60b0d255', '[\"*\"]', '2026-06-19 09:38:49', NULL, '2026-06-19 09:38:46', '2026-06-19 09:38:49'),
(72, 'App\\Models\\UserBiasa', 'usr008', 'auth_token', 'aa7f47a65a2c8add660e3ca21ed02d24553e17f7bbf7c21ea807c17a9e96fc46', '[\"*\"]', '2026-06-19 09:58:05', NULL, '2026-06-19 09:58:02', '2026-06-19 09:58:05'),
(73, 'App\\Models\\UserBiasa', 'usr008', 'auth_token', 'c0e2cbe953f47e5f4e90b44b28e18607f8f2ab6d62a9d9fe4b9b13c5327ca961', '[\"*\"]', '2026-06-19 10:05:35', NULL, '2026-06-19 10:05:33', '2026-06-19 10:05:35'),
(75, 'App\\Models\\UserBiasa', 'usr008', 'auth_token', 'a0ff63611e5995da99b968b63ecd4455869b5df4adc6b9ea968b71085d51ce44', '[\"*\"]', '2026-06-19 10:26:38', NULL, '2026-06-19 10:26:36', '2026-06-19 10:26:38'),
(78, 'App\\Models\\UserBiasa', 'usr002', 'auth_token', '944b723073228af3fe355b48857a1ae2448c1b85e6398e8a4c73f69d8eff3b8c', '[\"*\"]', NULL, NULL, '2026-06-19 10:59:20', '2026-06-19 10:59:20'),
(79, 'App\\Models\\UserBiasa', 'usr002', 'auth_token', '09b359d24131129b10aba731fec2ad9c178d2b25e9a7573bfd03896aa7f51178', '[\"*\"]', '2026-06-19 11:41:29', NULL, '2026-06-19 11:11:03', '2026-06-19 11:41:29'),
(80, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', 'e81fc871639ca203f1167b8852e505acca52f75105f1496f2fedc6b23ed1af95', '[\"*\"]', '2026-06-19 12:03:15', NULL, '2026-06-19 11:53:57', '2026-06-19 12:03:15'),
(81, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '1850374246a49a8817bce12f61219f8e9951e3d9e0d384e7f92dd9c5c298d25f', '[\"*\"]', NULL, NULL, '2026-06-19 12:04:17', '2026-06-19 12:04:17'),
(82, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '568fdaf51c61c3ab64e7326585514cf392c427a8e0bc2c1d8b0fbed8c6425f51', '[\"*\"]', '2026-06-19 12:04:43', NULL, '2026-06-19 12:04:39', '2026-06-19 12:04:43'),
(83, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '6d384d79bf8fa13529439294db4928b5daf0d3c696dd5f2fba501c6a3e4b3a9a', '[\"*\"]', '2026-06-20 19:24:56', NULL, '2026-06-19 12:05:55', '2026-06-20 19:24:56'),
(84, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '725dce9a71e016e83b4e3c7808f7c20f4967af6a7d9f340d81bf739415f2dc00', '[\"*\"]', '2026-06-19 12:19:10', NULL, '2026-06-19 12:19:03', '2026-06-19 12:19:10'),
(85, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '7f2b51bd2791fbd3f2219779024eddac0446e36dfd02206fd8d0b90a2af67cc8', '[\"*\"]', NULL, NULL, '2026-06-19 12:19:43', '2026-06-19 12:19:43'),
(86, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '9fbc8c7f94d259f992e4dcf8c5a61e2e8952fbea21e2dd4cbce5e83e0455aa81', '[\"*\"]', NULL, NULL, '2026-06-19 12:26:43', '2026-06-19 12:26:43'),
(87, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '2da230860d4d0e3f84a90ddf52e583cbf9e10a03ba85bae2cfb078f454a54f21', '[\"*\"]', '2026-06-19 12:27:05', NULL, '2026-06-19 12:27:02', '2026-06-19 12:27:05'),
(88, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', 'd3c877fe0ddada64575ae09d19b2179fadd66d78d0f2b5a65dd20bc105fec9c9', '[\"*\"]', '2026-06-19 16:45:01', NULL, '2026-06-19 16:25:26', '2026-06-19 16:45:01'),
(89, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', 'e04e843a0a543cc29414bc6740ef6e54e060dbc272f7a01bc3a97cb374a1adf7', '[\"*\"]', '2026-06-19 16:45:38', NULL, '2026-06-19 16:45:34', '2026-06-19 16:45:38'),
(90, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '5fabc52c2049ba5e7c1121c4b3ab3453442b74d98ae92bba1dd5ba910ebc29fa', '[\"*\"]', '2026-06-20 11:59:22', NULL, '2026-06-20 11:59:18', '2026-06-20 11:59:22'),
(91, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '84cb6f6858f42d6231497cc4d2fe4675938cc52bde3ef078b57bef4e0a790e57', '[\"*\"]', '2026-06-20 11:59:48', NULL, '2026-06-20 11:59:35', '2026-06-20 11:59:48'),
(92, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '803942346decd732640eace34251056b7123bb7835923ca4372d8912ca4331d2', '[\"*\"]', '2026-06-20 18:55:50', NULL, '2026-06-20 18:55:44', '2026-06-20 18:55:50'),
(93, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '056a5e1d4db74de988bf82adb0f552c19a9291a63f5e5b3f2e8f5d1d17b408e1', '[\"*\"]', NULL, NULL, '2026-06-20 18:56:42', '2026-06-20 18:56:42'),
(94, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', 'dac1d7c12c3ce404c68ebcbe4a02941768c49c1f160d89d5b36ceafca7585f8b', '[\"*\"]', '2026-06-20 19:07:19', NULL, '2026-06-20 19:02:28', '2026-06-20 19:07:19'),
(95, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '11bbbc38385da3651518a69b325a69196c3df4efbcaa90585e8e3c752e486683', '[\"*\"]', '2026-06-20 19:32:12', NULL, '2026-06-20 19:11:56', '2026-06-20 19:32:12'),
(96, 'App\\Models\\UserBiasa', 'usr003', 'auth_token', '120509f5cd34d961e2a40474c21dcfa1e28600c1926bc2f759f54c4605c35a3d', '[\"*\"]', '2026-06-20 19:46:12', NULL, '2026-06-20 19:44:21', '2026-06-20 19:46:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0MXmhjXIN1wrekgOvOZEcGsp1RWoMYADsrTvrmM5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiT2lLbDk0azczZ0FPVnp4Y2RhaGhSNUNDano1NDlNVjhYNlNsOE5mWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9NeVRpa2V0IjtzOjU6InJvdXRlIjtOO31zOjc6InVzZXJfaWQiO3M6NjoidXNyMDAzIjtzOjk6InVzZXJfbmFtZSI7czoxMzoiTml6YWwgTWF1bGFuYSI7fQ==', 1781984618),
('16P3YzTpJlqDnn81kqeh6OPknKR40YsrIs9JMhhr', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUFyVU1mY29hc2ZKVEszRDJCVnY1aTVQVVVXMk5RMkE4S3VyV2pYMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODA6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9OYXR1cmUucG5nIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780828230),
('1qglNt8PWnVqNpMBaHCzmEg7yJFGVhaj2Zwj776Y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUUh0VjVzVWJvNTlGR003UXhKUG9EQTA0cWdiQ2l4MDhoMHBrSUxCQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9HYWxsZXJ5IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO3M6NjoidXNyMDA2IjtzOjk6InVzZXJfbmFtZSI7czoxNDoiTmF1ZmFsIEdlcmFsZG8iO30=', 1780829466),
('2i8SEaxyo0pFHs0hY2CzhWPDLmKRZKjA7VsdXzoW', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidzFrUUlmbDBsVlJvV0VVeGZETFMwNUpRbE1lVmpCeGxMWmR4eDNKVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODA6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9OYXR1cmUucG5nIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780828009),
('2yPg4sjCjrcVYcX8etJjKjqiCcrsdKWt78PAulSX', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWG4zWjZzZm0wYjIxSndKMDFVbjduSDkyWGVMcUxIaG5mdGhYZnhkNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9IaXN0b3J5LmpwZyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780828007),
('30Py8LvCAqAg1VaX1v7uSbGMbULhLKNksGxXuqgC', NULL, '127.0.0.1', 'WhatsApp/2.2620.102 W', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1MwN3hXejhjQUlkNDI5cUQxSnd0OXR1a0hjUUZpSUNqTUV1THh2byI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780828204),
('54Lk74hbwjhWeGmd3GaEVQujeNBI8EkcLOOSj3X6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSnVvbVZvYlRPUzBzYzMxajkyTElvUVB0NkdXdEFKUmRxdWM4a1ZzZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9FdmVudCI7czo1OiJyb3V0ZSI7Tjt9czo3OiJ1c2VyX2lkIjtzOjY6InVzcjAwMSI7czo5OiJ1c2VyX25hbWUiO3M6MTM6IkRoaW1hcyBIYWZpemgiO30=', 1780846569),
('8FiRhRzfNkYmVRHbSdVrMWwdayiVZGBXejwC7PFv', NULL, '127.0.0.1', 'python-requests/2.32.5', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXRONUh1RGZOTnhpSXFON0hPRmxnQ2s1SFZYRlVxUnZRbzkxQzJKTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780831997),
('ceCVjSVYHXOtvIRmF5fGPTCbqB4fZcBsiSV2u0Tm', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3RqbmRscmFoczYxaFN2aWJIVWpCemt0YXF5ZkNpYnZoV0ZhZmdBTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9DdWx0dXJlLmpwZyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780828009),
('dnXLkPvYNy6sjGuAAI7yCkooMKAZ02v06VhkQXR9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTWVFVzBZbG9jYkc2N01mS2dtS3hVeDIzaGNZbHAyODBOZHlxQkIzeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9NeVRpa2V0IjtzOjU6InJvdXRlIjtOO31zOjc6InVzZXJfaWQiO3M6NjoidXNyMDAzIjtzOjk6InVzZXJfbmFtZSI7czoxMzoiTml6YWwgTWF1bGFuYSI7fQ==', 1781869635),
('hIwwl4zfu20l1hIgNY1Vq3QKNSa3hOfx49IRCbyK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiN0lRS1owYXFCMHk0OHUwc1liU2YxQWdaR3U3Wkw5S1VOYmVlWXhGMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMToicmVzZXRfZW1haWwiO3M6MjQ6ImRoaW1hcy5oZnpoMzc1QGdtYWlsLmNvbSI7czo5OiJyZXNldF9vdHAiO2k6NjQyMTU3O3M6MTI6Im90cF92ZXJpZmllZCI7YjoxO30=', 1781618221),
('IHsRHJdVv0glPFq5iiTNidWEhoSfi9LOZz1zTxGu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTo1OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiSWVnVXBGT0dNcFlRTlBhbDJYbmZ5eE5WbGt3RkdTeEI4UDVRV3AzOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9Ib21lcGFnZSI7czo1OiJyb3V0ZSI7Tjt9czo3OiJ1c2VyX2lkIjtzOjY6InVzcjAwNSI7czo5OiJ1c2VyX25hbWUiO3M6MTI6IklyZmFuIFRob3JpcSI7fQ==', 1780910310),
('J7YJ5ruEXz4CoLGRnyBBAKm92jb6dn4BXshb4eZd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieVBxUGhMcFFwamNkQzNqOTN3NkhaMDgyNkFmbDFmUGF0NDNEUEpmdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9EZXN0aW5hdGlvbj9zZWFyY2g9Y2FuZGkiO3M6NToicm91dGUiO047fXM6NzoidXNlcl9pZCI7czo2OiJ1c3IwMDMiO3M6OToidXNlcl9uYW1lIjtzOjEzOiJOaXphbCBNYXVsYW5hIjt9', 1780825237),
('jTLk76KOeUefCpF8gsMFjjDSR5ga1Rc4nOyuKXEY', NULL, '127.0.0.1', 'WhatsApp/2.2620.102 W', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkRtZFJ3SkpScEtreVVxZzlTVW1JOXdKU2pUMzJyUUxtV2tVZjBaeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781864665),
('JwSymLgYvqDX1l88ircpqyBM9CRkFpYnFh8N9gH2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaHY0VjU4OXNPYmV6cUoxZjlFQUdmelhwdmJnTzRNc29vTkg4d2k4cCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9FdmVudC9EZXRhaWwvZXZ0MDAyIjtzOjU6InJvdXRlIjtOO31zOjc6InVzZXJfaWQiO3M6NjoidXNyMDAxIjtzOjk6InVzZXJfbmFtZSI7czoxMzoiRGhpbWFzIEhhZml6aCI7fQ==', 1780856196),
('k875jPLs09uE0A4pmvbzhcE1y2USozqudjFgxSUp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV3ZsQ1Q3NUpQRHhkOU1nTHEwb3Y4NnhsaHdPSlNBclAyekNlSnlzaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9NeVRpa2V0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO3M6NjoidXNyMDAzIjtzOjk6InVzZXJfbmFtZSI7czoxMzoiTml6YWwgTWF1bGFuYSI7fQ==', 1781954871),
('kgSlSFjwpWLdnYB5mgS1h6HJ3OENblXiUyTQRovv', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1paUlc1OEZGOWR3SFpSbDJtcWhqb3dWcDFGOFNGRnlvYlFCWUFmaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODM6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9FZHVjYXRpb24uanBnIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780828008),
('KyCPh80sRBHbBdDg0ZpEhweB9HgGS74ffBurXYQp', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGpSdDNEZmZOU3JER29vMG11c3drWTN4YTI4dkZZeDdWWFh1cFp6MSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9IaXN0b3J5LmpwZyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780828228),
('mlDGMpqP2bTlwFM1zwZinNJJPNv8yOl5jP4HQITo', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUJHbEpWN3pDWkNyTXFNWlZQdW1aSnVtSjdRejlKWnhZYTNhUlNGYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9DdWx0dXJlLmpwZyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780828229),
('Nzo05skcrarcIWnhdAeWGEDxqmJH39IfEHA166TW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDVCRlRRNmlkdnZHakkyNXkzT0VGcjhvemMwSjVTeUlKbmZnd1l1ayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781869604),
('octVnU9INarNQwFubzUGazfz1VFmf5673k8ErbOQ', NULL, '192.168.1.40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTBBRjNXY1Bzc3I5ZXpNWm5MNGxXd0ltdGpMTnl5dE9vWlpWRkhsTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly8xOTIuMTY4LjEuNDA6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780821436),
('oEjnH1ox2KOM8cBwAU4H91TQ0ehsDU8G6qLrfOjX', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHlCc3VNYW05aVBCUENFYWlPUFBRV1BHT3EzZnVncnRnSFVPUkd1MSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9CZWFjaC5qcGciO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1780828007),
('pLqj0Rcrz3SIDCqRafPcjZzet8JnFzvqgVGCfjkj', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQVVzZ0xUWmkzeXlodDdFOWxWVFRHbllUZzZyNFh3MjdaNkpRSFpaSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjQ6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi90aWtldC9wcmludC9US1VRWUMiO3M6NToicm91dGUiO3M6MTE6InRpa2V0LnByaW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtzOjY6InVzcjAwMSI7czo5OiJ1c2VyX25hbWUiO3M6MTM6IkRoaW1hcyBIYWZpemgiO30=', 1780828321),
('PTPtorPp9GjQmIYHnWGs6KmEShuwqVy0FoNbjLID', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkR6b1JlYnJMcDRGZUFLTmxZTjM0WmFPNHUzNHV3NkJzRmpMcWp3ZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780827845),
('q9Qcp6qOrCLm4naQo8YlYgPH0e2HNNAtq3XbsPnj', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWxCczRrRUhqVFUxTDh1eTZrSGxXMHN3eW9iU3dybW01SmJxN1ZwSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODQ6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9FY290b3VyaXNtLnBuZyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780828229),
('QEFngAlt2X9XPCska5PPgBkXPJEgb224VJD2zAnh', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVnhFNVVYU1dmaTlFNUpjWm9NQlZleUNEcWtkRG5wNHduTjc0aHViMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9Ib21lcGFnZSI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtzOjY6InVzcjAwNCI7czo5OiJ1c2VyX25hbWUiO3M6MTE6IkRhZmZhIEZhbGloIjt9', 1780828746),
('REHMRlVhtt0kMQplmyybCaNRVqZAZB9o0U64oM8F', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWVjd25LTjhJR21RMGxRd3Frak5HVzNzYThDQU1Lak16UFl1V05pYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODM6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9FZHVjYXRpb24uanBnIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780828229),
('rJ18LAhGKCFm2qHEqJSVBBL4wtB0dnUcz0zlOutK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid1hJZ3RwMFlqS3Z2ajBRRnRqRHh3R3hmdVVqaGRPbkY2MGNtblNQaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODI6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9EZXN0aW5hdGlvbi9DYXRlZ29yeT9DYXRlZ29yeT1jdGcwMDEiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7czo2OiJ1c3IwMDEiO3M6OToidXNlcl9uYW1lIjtzOjEzOiJEaGltYXMgSGFmaXpoIjt9', 1780829308),
('rw4mN9p98l39eGh3txYXd3PmnOPwanAP9DuU9YY9', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlRuQjFkVVpxNGl5Mk9NZjY3TEJ0RUNyenp6cFgyb2ZZemhoZW1sNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780831864),
('s8pdiQVRaWBu1ZqY6JEC5fuemrMBlmiSO0yuGsUZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTjlzSGhscVdTSmhRM2ZGbjhoQTg4SHlBemxBTW9MMW1QZDY3Y0JkaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9BY2NvdW50IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO3M6NjoidXNyMDA4IjtzOjk6InVzZXJfbmFtZSI7czo4OiJha3VuIHRlcyI7fQ==', 1781861206),
('UBPFNDGvgl6Pq8rWyXYIqf1OZuA5ncDa2HfVmogW', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQjNSVHRzMk5vWlhtemlqMnZQRW05M21GMWRvQ2tTYkoyNlA0QlBkZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9EZXN0aW5hdGlvbiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtzOjY6InVzcjAwNSI7czo5OiJ1c2VyX25hbWUiO3M6MTI6IklyZmFuIFRob3JpcSI7fQ==', 1780828740),
('us7Sva6OxVifmnp86mZp7eF8EsxrTXNmnapJWZKd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiODBkRTlKcExGSDFyb2JxTFNJUnBZVk1OaTNEb1hIRjZhNE1hQkZWeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781861085),
('UwB0fyr8LZSmfZVJwnOVTheisJTPwH0Nqxm45j4z', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibG1HbjNXdzVTUjBRcjJScHhTSDZSTHBmNm5LY2drOThXVEIxMDVhbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODQ6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9FY290b3VyaXNtLnBuZyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780828008),
('x0myozDzbXJbpmSBOcqpvKf8LrT7YBD9EajLKWU0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVWhuem0xWnE3MVZmM3B2MlZwYWR2YUVOekg4bEk5Z2FlQXoydkZDdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi9HYWxsZXJ5IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO3M6NjoidXNyMDAxIjtzOjk6InVzZXJfbmFtZSI7czoxMzoiRGhpbWFzIEhhZml6aCI7fQ==', 1780906357),
('ylMEoushMTPsVsgUaMED4tHPdlIYNWFrfHZo9kOD', NULL, '127.0.0.1', 'Dart/3.11 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicmdxQXJFUGFXME5oTldRTlZVZmh2RHN5OTFOZmxlbEhtNE85dVNtOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sZWdhbC1zaXR0aW5nLXdvbWFuaG9vZC5uZ3Jvay1mcmVlLmRldi8vc3RvcmFnZS9kZXN0Y2F0ZWdvcmllcy9CZWFjaC5qcGciO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1780828228);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `tiketID` varchar(6) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tiketStatus` tinyint(1) NOT NULL,
  `eventID` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `orderID` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tiket`
--

INSERT INTO `tiket` (`tiketID`, `price`, `tiketStatus`, `eventID`, `orderID`) VALUES
('TK4VO4', 100.00, 1, 'evt001', 'ODDABM'),
('TKB2VA', 150000.00, 0, 'evt002', 'OD85LH'),
('TKCUB2', 150000.00, 0, 'evt002', 'OD5SFG'),
('TKF4YQ', 100.00, 2, 'evt001', 'ODDAAX'),
('TKGHAD', 100000.00, 1, 'evt003', 'OD2QZP'),
('TKHFUR', 150000.00, 0, 'evt002', 'ODZPYR'),
('TKHMXE', 100.00, 0, 'evt001', 'ODAIMH'),
('TKJRYB', 100000.00, 1, 'evt003', 'ODKLGF'),
('TKMPWD', 150000.00, 0, 'evt002', 'ODZ969'),
('TKOAGI', 150000.00, 1, 'evt002', 'OD2RLE'),
('TKQW4U', 150000.00, 0, 'evt002', 'ODQDQK'),
('TKRSBR', 100000.00, 0, 'evt003', 'ODCXVQ'),
('TKS9WJ', 100000.00, 1, 'evt003', 'ODMRL8'),
('TKSXEM', 100.00, 1, 'evt001', 'ODGRZU'),
('TKUQYC', 100000.00, 1, 'evt003', 'ODUSLP'),
('TKVNA4', 100000.00, 0, 'evt003', 'ODVMJL'),
('TKWVKN', 150000.00, 0, 'evt002', 'ODZPYR'),
('TKY53B', 100000.00, 0, 'evt003', 'ODLNXP'),
('TKY5QK', 100000.00, 1, 'evt003', 'ODVVMK'),
('TKYXJ8', 100.00, 0, 'evt001', 'ODAIMH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userID` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nameUser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthDate` date NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userID`, `nameUser`, `email`, `phone`, `gender`, `birthDate`, `username`, `password`, `deleted_at`, `created_at`, `updated_at`) VALUES
('usr001', 'Dhimas Hafizh', 'dhimas.hfzh375@gmail.com', '081290071606', 1, '2005-07-02', 'UserDhimas', '$2y$12$rHpvXQ/iyOdu6e0T7LxqPu.V0w1vt57y.38ygf8ru9JvwDvI5iEOC', NULL, '2026-01-01 14:38:08', '2026-06-08 08:41:27'),
('usr002', 'Christoba Joshua', 'Akunkhusustugas51@gmail.com', '085348455669', 1, '2005-09-27', 'UserJoshua', '$2y$12$nngpJXs269lQTAx1PdfNAu7dfZq5R5aSK2Vz0pNdzVDb.hKuq0aEG', NULL, '2026-01-10 14:38:08', NULL),
('usr003', 'Nizal Maulana', 'roniiinaldo601@gmail.com', '081476626723', 1, '2005-04-26', 'UserNizal', '$2y$12$PG0kQ9z.pdDX4FrwBSo6yunvG5Uz0y7Ss37IIe6hGMGEt0whTmkjm', NULL, '2026-02-05 14:38:08', '2026-06-18 13:35:46'),
('usr004', 'Daffa Falih', 'daffalih75@gmail.com', '085174235775', 1, '2005-06-13', 'UserDaffa', '$2y$12$3M43bbpkkyHLDjLs4hI.quBdgeGxtGJVRoa1Lxzoj34ozP2F07u/W', NULL, '2026-02-26 14:38:08', NULL),
('usr005', 'Irfan Thoriq', 'Nnfaff59@gmail.com', '081337195915', 1, '2005-03-12', 'UserIrfan', '$2y$12$V6p/v8qyPSg2BPbnWbLi/OdSMvtCxc8S1cvE66l/Hbyd4wsJW1Un2', NULL, '2026-03-04 14:38:08', NULL),
('usr006', 'Naufal Geraldo', 'naufal.geraldo30@gmail.com', '081289492745', 0, '2005-05-30', 'UserNaufal', '$2y$12$tLr22l6fHSStp3svM559.e872uh9Nrix0UU7OqBpcavSlcy.999wC', NULL, '2026-05-07 14:38:08', '2026-06-05 16:01:18'),
('usr007', 'Arsyad Zaidan', '2311102058@ittelkom-pwt.ac.id', '081574166613', 1, '2005-03-03', 'UserZaidan', '$2y$12$vwwhMXmuyVEgpTGiPttltufde4oM6nf6rjFQ8otdidXi2.p760T1O', NULL, '2026-05-15 14:38:08', NULL),
('usr008', 'akun tes', 'tes@gmail.com', '081290071606', 1, '2026-06-01', 'testing', '$2y$12$MnYq1Gz/M/EvmcyUi4PIa.lXfUvuiWxmu.sE3wEkd0FnMUmX6CVVG', '2026-06-19 10:28:43', '2026-06-19 09:16:49', '2026-06-19 10:28:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indeks untuk tabel `destcategory`
--
ALTER TABLE `destcategory`
  ADD PRIMARY KEY (`destCategoryID`);

--
-- Indeks untuk tabel `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`destinationID`),
  ADD KEY `adminID` (`adminID`),
  ADD KEY `destCategoryID` (`destCategoryID`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `adminID` (`adminID`),
  ADD KEY `destinationID` (`destinationID`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `userID` (`orderID`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`tiketID`),
  ADD KEY `eventID` (`eventID`,`orderID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `destination`
--
ALTER TABLE `destination`
  ADD CONSTRAINT `destination_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`),
  ADD CONSTRAINT `destination_ibfk_2` FOREIGN KEY (`destCategoryID`) REFERENCES `destcategory` (`destCategoryID`);

--
-- Ketidakleluasaan untuk tabel `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`destinationID`) REFERENCES `destination` (`destinationID`);

--
-- Ketidakleluasaan untuk tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`);

--
-- Ketidakleluasaan untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`),
  ADD CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
