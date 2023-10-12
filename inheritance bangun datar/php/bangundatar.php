<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator Bangun Datar</title>
</head>
<body>
    <h1>Kalkulator Bangun Datar</h1>

    <form action="" method="post">
        <label>Pilih Bangun Datar:</label>
        <select name="bangun_datar" id="bangun_datar">
            <option value="persegi">Persegi</option>
            <option value="persegi_panjang">Persegi Panjang</option>
            <option value="segitiga">Segitiga</option>
            <option value="lingkaran">Lingkaran</option>
        </select>
        <div id="input-container">
            <!-- Input fields will be displayed here based on user's choice -->
        </div>
        <input type="submit" value="Hitung">
    </form>

    <?php
    class BangunDatar {
        protected $luas;
        protected $keliling;

        public function getLuas() {
            return $this->luas;
        }

        public function setLuas($luas) {
            $this->luas = $luas;
        }

        public function getKeliling() {
            return $this->keliling;
        }

        public function setKeliling($keliling) {
            $this->keliling = $keliling;
        }
    }

    class Persegi extends BangunDatar {
        private $sisi;

        public function __construct($sisi) {
            $this->sisi = $sisi;
            $this->setLuas($sisi * $sisi);
            $this->setKeliling(4 * $sisi);
        }
    }

    class PersegiPanjang extends BangunDatar {
        private $panjang;
        private $lebar;

        public function __construct($panjang, $lebar) {
            $this->panjang = $panjang;
            $this->lebar = $lebar;
            $this->setLuas($lebar * $panjang);
            $this->setKeliling(2 * $panjang + 2 * $lebar);
        }
    }

    class Segitiga extends BangunDatar {
        private $alas;
        private $tinggi;

        public function __construct($alas, $tinggi) {
            $this->alas = $alas;
            $this->tinggi = $tinggi;
            $this->setLuas($alas * $tinggi / 2);
            $this->setKeliling($alas + $tinggi + sqrt($alas*$alas + $tinggi*$tinggi));
        }
    }

    class Lingkaran extends BangunDatar {
        private $jari_jari;

        public function __construct($jari_jari) {
            $this->jari_jari = $jari_jari;
            $this->setLuas(3.14 * $jari_jari * $jari_jari);
            $this->setKeliling(2 * 3.14 * $jari_jari);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bangun_datar = $_POST['bangun_datar'];

        if ($bangun_datar === 'persegi') {
            if (isset($_POST['sisi'])) { // Periksa apakah 'sisi' ada dalam $_POST
                $sisi = (float)$_POST['sisi'];
                $persegi = new Persegi($sisi);
                echo "Luas Persegi: " . $persegi->getLuas() . "<br>";
                echo "Keliling Persegi: " . $persegi->getKeliling();
            } else {
                echo "Sisi tidak diisi. Silakan masukkan nilai sisi.";
            }
        } elseif ($bangun_datar === 'persegi_panjang') {
            $panjang = (float)$_POST['panjang'];
            $lebar = (float)$_POST['lebar'];
            $persegi_panjang = new PersegiPanjang($panjang, $lebar);
            echo "Luas Persegi Panjang: " . $persegi_panjang->getLuas() . "<br>";
            echo "Keliling Persegi Panjang: " . $persegi_panjang->getKeliling();
        } elseif ($bangun_datar === 'segitiga') {
            $alas = (float)$_POST['alas'];
            $tinggi = (float)$_POST['tinggi'];
            $segitiga = new Segitiga($alas, $tinggi);
            echo "Luas Segitiga: " . $segitiga->getLuas() . "<br>";
            echo "Keliling Segitiga: " . $segitiga->getKeliling();
        } elseif ($bangun_datar === 'lingkaran') {
            $jari_jari = (float)$_POST['jari_jari'];
            $lingkaran = new Lingkaran($jari_jari);
            echo "Luas Lingkaran: " . $lingkaran->getLuas() . "<br>";
            echo "Keliling Lingkaran: " . $lingkaran->getKeliling();
        }
    }
    ?>
    <script>
        const bangunDatarSelect = document.getElementById('bangun_datar');
        const inputContainer = document.getElementById('input-container');

        bangunDatarSelect.addEventListener('change', (e) => {
            inputContainer.innerHTML = '';

            const selectedOption = e.target.value;
            if (selectedOption === 'persegi') {
                inputContainer.innerHTML = `
                    <label for="sisi">Sisi:</label>
                    <input type="number" name="sisi" id="sisi" required>
                `;
            } else if (selectedOption === 'persegi_panjang') {
                inputContainer.innerHTML = `
                    <label for="panjang">Panjang:</label>
                    <input type="number" name="panjang" id="panjang" required>
                    <label for="lebar">Lebar:</label>
                    <input type="number" name="lebar" id="lebar" required>
                `;
            } else if (selectedOption === 'segitiga') {
                inputContainer.innerHTML = `
                    <label for="alas">Alas:</label>
                    <input type="number" name="alas" id="alas" required>
                    <label for="tinggi">Tinggi:</label>
                    <input type="number" name="tinggi" id="tinggi" required>
                `;
            } else if (selectedOption === 'lingkaran') {
                inputContainer.innerHTML = `
                    <label for="jari_jari">Jari-Jari:</label>
                    <input type="number" name="jari_jari" id="jari_jari" required>
                `;
            }
        });
    </script>
</body>
</html>
