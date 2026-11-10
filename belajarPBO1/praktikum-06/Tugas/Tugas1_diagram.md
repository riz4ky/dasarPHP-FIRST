Berikut ini merupakan diagram yang menghubungkan antara Mahasiswa, MahasiswaReguler, dan MahasiswaBeasiswa:
+------------------------------------------------------------+
| <<Abstrak>> |
| Mahasiswa |
| (PARENT) |
+------------------------------------------------------------+
| nim: string |
| - nama: string |
| - prodi: string |
| - semester: int |
| - alamat: string |
+------------------------------------------------------------+
| + **construct(nim: string, nama: string, |
| prodi: string, semester: int, |
| alamat: string) |
| + getNim(): string |
| + getNama(): string |
| + getProdi(): string |
| + getSemester(): int |
| + getAlamat(): string |
| + abstract hitungBiaya(): int |
| + abstract getJenis(): string |
+------------------------------------------------------------+
^
|Extends
+---------------------+---------------------+
| |
+-----------------------+ +--------------------------------+
| <<FINAL>> | | <<FINAL>> |
| MahasiswaReguler | | MahasiswaBeasiswa |
| (CHILD) | | (CHILD) |
+-----------------------+ +--------------------------------+
| - ukt: int | | - ukt: int |
| | | - potonganPersen: int |
+-----------------------+ +--------------------------------+
| + **construct(...) | | + \_\_construct(...) |
| + getUkt(): int | | + getUkt(): int |
| + hitungBiaya(): int | | + getPotonganPersen(): int |
| + getJenis(): string | | + hitungBiaya(): int |
| | | + getJenis(): string |
+------------------------------------------------------------+

Perancangan Diagram Class pada sistem pengolahan data mahasiswa, menempatkan kelas Mahasiswa sebagai abstract parent class untuk mengelompokkan entitas dasar yang dimiliki oleh semua jenis mahasiswa. Atribut identitas umum seperti nim, nama, prodi, semester, dan alamat beserta method pemanggilnya (getNim(), getNama(), getProdi(), getSemester()) dituliskan secara terpusat pada kelas parent. Pemilihan struktur abstract class dilakukan karena kelas Mahasiswa secara umum belum memiliki skema perhitungan biaya perkuliahan yang spesifik dan riil. Dengan mencegah instansiasi langsung pada kelas induk, arsitektur sistem memastikan bahwa setiap objek mahasiswa yang dibuat dalam aplikasi harus berupa kelas turunan yang telah mendefinisikan aturan biaya dan jenis mahasiswanya secara spesifik.
Adapun alasan saya memilih desain ini yaitu:
• Efisiensi penulisan kode, karena atribut seperti nim, nama, prodi, semester, dan alamat hanya dideklarasikan sekali pada parent class Mahasiswa. Tanpa pewarisan, kelas MahasiswaReguler dan MahasiswaBeasiswa akan dipaksa menuliskan ulang seluruh atribut identitas dasar beserta validasinya secara berulang. Dengan mewariskan atribut umum dari kelas induk, kelas turunan dapat berfokus sepenuhnya pada variabel dan aturan spesifik lainnya.
• Konsistensi kontrak melalui abstraksi karena mendefinisikan hitungBiaya() dan getJenis() sebagai abstract method memastikan setiap jenis mahasiswa memiliki antarmuka perhitungan yang seragam. Deklarasi method abstraksi dapat menjamin antarmuka pemanggilan yang seragam bagi seluruh jenis mahasiswa. Pola desain ini memungkinkan layer repositori data (DataMahasiswa) mengolah objek MahasiswaReguler maupun MahasiswaBeasiswa secara polimorfik tanpa perlu melakukan pengecekan tipe kelas secara eksplisit menggunakan instanceof. Hal ini memberikan fleksibilitas pengembangan yang tinggi apabila di masa mendatang sistem akan ditambah dengan jenis mahasiswa baru.
• Kemudahan Pembagian Tanggung Jawab karena parent memvalidasi identitas umum, sedangkan child memvalidasi komponen spesifik seperti batasan UKT dan persen potongan beasiswa. Penggunaan kata kunci private pada atribut induk menjaga enkapsulasi secara ketat sehingga kelas turunan tidak dapat mengubah variabel identitas secara langsung tanpa melalui pemanggilan parent::\_\_construct() atau pemanggilan getter method. Di sisi lain, penggunaan atribut bertipe protected memberikan ruang bagi kelas anak untuk mengakses data induk secara langsung tanpa membuka akses tersebut ke publik luar kelas. Kombinasi enkapsulasi ketat dan hirarki pewarisan ini menghasilkan arsitektur sistem yang aman, modular, dan patuh pada kaidah pemograman berorientasi objek.

Penerapan enkapsulasi dalam pewarisan (inheritance) bertujuan untuk mengontrol sejauh mana atribut dan method dari class induk (parent class) dapat diakses oleh class anak (child class) maupun oleh kode luar. Pemilihan kata kunci akses seperti private dan protected menentukan tingkat perlindungan data serta fleksibilitas pengoperasian variabel di dalam struktur program. Pada kasus nyata pengoperasian class Mahasiswa beserta turunannya seperti MahasiswaReguler dan MahasiswaBeasiswa, perbedaan mendasar kedua penentu hak akses ini berfokus pada ada atau tidaknya izin bagi class anak untuk memanipulasi properti induk secara langsung.
Pada penerapan contoh nyata, kata kunci private digunakan untuk melindung atribut inti seperti $nim, $nama, $prodi, $semester, $alamat pada class induk Mahasiswa. Kata kunci private memastikan bahwa variabel-variabel tersebut hanya dapat dibaca dan dimodifikasi secara langsung di dalam class Mahasiswa itu sendiri. Apabila class anak seperti MahasiswaReguler mencoba mengakses variabel $this->nim secara langsung, interpreter PHP akan menghasilkan error karena child class tidak memiliki hak akses langsung terhadap properti private milik parent. Oleh karena itu, class anak harus memanfaatkan antarmuka terkontrol seperti getter method publik ($this->getNim()) yang disediakan oleh induknya, sehingga integritas data identitas mahasiswa tetap terjaga dari perubahan tidak sah.

Di sisi lain, kata kunci protected memberikan ruang akses yang lebih fleksibel bagi hierarki keluarga class tanpa membuka data tersebut ke publik luar. Sebagai contoh nyata, jika class induk Mahasiswa memiliki atribut protected string $kategori atau protected int $tarifDasar, maka class turunan seperti MahasiswaReguler dan MahasiswaBeasiswa dapat membaca maupun mengabaikan nilai variabel $this->kategori tersebut secara langsung di dalam method internal mereka.
