<?php
// 1. SESSION - Startujemy sesję, aby serwer pamiętał nasz koszyk
session_start();

// 2. STAŁE (Stałe) - Wartości niezmienne
define('VAT', 0.23);
define('WALUTA', 'PLN');

// 3. KLASY (klasy) - Szablon produktu
class Produkt {
    public $id;
    public $nazwa;
    public $cena;
    public $kategoria;

    public function __construct($id, $nazwa, $cena, $kategoria) {
        $this->id = $id;
        $this->nazwa = $nazwa;
        $this->cena = $cena;
        $this->kategoria = $kategoria;
    }
}

// 4. ARRAY (Tablice) - Ręczna lista 55 produktów
$oferta = [
    // ELEKTRONIKA
    1  => new Produkt(1, "Słuchawki Gamingowe Pro", 350, "Elektronika"),
    2  => new Produkt(2, "Myszka Bezprzewodowa RGB", 190, "Elektronika"),
    3  => new Produkt(3, "Klawiatura Mechaniczna", 450, "Elektronika"),
    4  => new Produkt(4, "Podkładka pod mysz XXL", 80, "Elektronika"),
    5  => new Produkt(5, "Monitor 27 cali 144Hz", 1100, "Elektronika"),
    6  => new Produkt(6, "Karta Graficzna RTX 4060", 1450, "Elektronika"),
    7  => new Produkt(7, "Procesor i5-13600K", 1300, "Elektronika"),
    8  => new Produkt(8, "Pamięć RAM DDR5 32GB", 550, "Elektronika"),
    9  => new Produkt(9, "Dysk SSD NVMe 1TB", 320, "Elektronika"),
    10 => new Produkt(10, "Zasilacz 750W Gold", 420, "Elektronika"),
    // TELEFONY
    11 => new Produkt(11, "Smartfon Flagowy 5G", 4200, "Telefony"),
    12 => new Produkt(12, "Tablet 11 cali", 2100, "Telefony"),
    13 => new Produkt(13, "Etui Silikonowe", 45, "Telefony"),
    14 => new Produkt(14, "Szkło Hartowane", 30, "Telefony"),
    15 => new Produkt(15, "Ładowarka Szybka 65W", 120, "Telefony"),
    16 => new Produkt(16, "Powerbank 20000mAh", 160, "Telefony"),
    17 => new Produkt(17, "Słuchawki TWS", 299, "Telefony"),
    18 => new Produkt(18, "Smartwatch Sportowy", 750, "Telefony"),
    19 => new Produkt(19, "Kabel USB-C 2m", 35, "Telefony"),
    20 => new Produkt(20, "Uchwyt Samochodowy", 85, "Telefony"),
    // BIURO
    21 => new Produkt(21, "Lampka Biurkowa LED", 115, "Biuro"),
    22 => new Produkt(22, "Organizer na biurko", 55, "Biuro"),
    23 => new Produkt(23, "Niszczarka Dokumentów", 230, "Biuro"),
    24 => new Produkt(24, "Drukarka Laserowa", 850, "Biuro"),
    25 => new Produkt(25, "Papier ksero A4", 25, "Biuro"),
    26 => new Produkt(26, "Kalkulator Naukowy", 95, "Biuro"),
    27 => new Produkt(27, "Fotel Ergonomiczny", 1200, "Biuro"),
    28 => new Produkt(28, "Biurko Regulowane", 1500, "Biuro"),
    29 => new Produkt(29, "Zestaw Długopisów", 30, "Biuro"),
    30 => new Produkt(30, "Tablica Korkowa", 60, "Biuro"),
    // AUDIO/FOTO
    31 => new Produkt(31, "Głośniki 2.1", 310, "Audio"),
    32 => new Produkt(32, "Soundbar TV", 850, "Audio"),
    33 => new Produkt(33, "Aparat Cyfrowy", 2500, "Foto"),
    34 => new Produkt(34, "Statyw Foto", 180, "Foto"),
    35 => new Produkt(35, "Mikrofon USB", 320, "Audio"),
    36 => new Produkt(36, "Słuchawki Studyjne", 600, "Audio"),
    37 => new Produkt(37, "Obiektyw 50mm", 800, "Foto"),
    38 => new Produkt(38, "Torba na Aparat", 150, "Foto"),
    39 => new Produkt(39, "Gramofon Retro", 550, "Audio"),
    40 => new Produkt(40, "Płyta Winylowa", 120, "Audio"),
    // GADŻETY
    41 => new Produkt(41, "Pendrive 128GB", 65, "Gadżety"),
    42 => new Produkt(42, "Hub USB-C", 180, "Gadżety"),
    43 => new Produkt(43, "Czytnik E-booków", 580, "Gadżety"),
    44 => new Produkt(44, "Router Wi-Fi 6", 420, "Gadżety"),
    45 => new Produkt(45, "Dysk Zewnętrzny 2TB", 350, "Gadżety"),
    46 => new Produkt(46, "Kamera IP Wi-Fi", 210, "Gadżety"),
    47 => new Produkt(47, "Smart Gniazdko", 70, "Gadżety"),
    48 => new Produkt(48, "Wentylator USB", 40, "Gadżety"),
    49 => new Produkt(49, "Torba na Laptopa", 130, "Gadżety"),
    50 => new Produkt(50, "Podstawka pod Laptopa", 90, "Gadżety"),
    51 => new Produkt(51, "Głośnik Bluetooth Mini", 110, "Audio"),
    52 => new Produkt(52, "Zestaw Czyszczący Ekran", 25, "Gadżety"),
    53 => new Produkt(53, "Lampka RGB na Monitor", 190, "Elektronika"),
    54 => new Produkt(54, "Kabel HDMI 5m", 60, "Elektronika"),
    55 => new Produkt(55, "Baterie Akumulatorki", 85, "Gadżety")
];

// 5. GET - Pobieranie filtrów z adresu URL
$wybranaKat = $_GET['kat'] ?? '';
$szukaj = $_GET['szukaj'] ?? '';

// Filtrowanie tablicy
$filtrowanaOferta = array_filter($oferta, function($p) use ($wybranaKat, $szukaj) {
    $pasujeKat = empty($wybranaKat) || $p->kategoria === $wybranaKat;
    $pasujeNazwa = empty($szukaj) || stripos($p->nazwa, $szukaj) !== false;
    return $pasujeKat && $pasujeNazwa;
});

// Pobranie unikalnych kategorii do menu
$wszystkieKategorie = array_unique(array_map(fn($p) => $p->kategoria, $oferta));

// 6. POST - Obsługa akcji (Dodaj, Usuń, Kup)
$komunikat = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dodaj_id'])) {
        $id = (int)$_POST['dodaj_id'];
        $_SESSION['koszyk'][] = $oferta[$id];
    }
    if (isset($_POST['usun_indeks'])) {
        $idx = (int)$_POST['usun_indeks'];
        unset($_SESSION['koszyk'][$idx]);
        $_SESSION['koszyk'] = array_values($_SESSION['koszyk']);
    }
    if (isset($_POST['kupuj'])) {
        if (!empty($_SESSION['koszyk'])) {
            $komunikat = "Dziękujemy za zakupy! Zamówienie wysłane.";
            unset($_SESSION['koszyk']);
        }
    }
}
// 7. KLASA STD (klasa STD) - Obliczanie podsumowania
$koszykInfo = new stdClass();
$koszykInfo->netto = 0;
if (!empty($_SESSION['koszyk'])) {
    foreach ($_SESSION['koszyk'] as $p) { $koszykInfo->netto += $p->cena; }
}
$koszykInfo->brutto = $koszykInfo->netto * (1 + VAT);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sklep PHP - 55 Produktów</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; padding: 20px; display: grid; grid-template-columns: 250px 1fr 300px; gap: 20px; }
        .panel { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); height: fit-content; }
        .scroll { height: 85vh; overflow-y: auto; }
        .produkt { border-bottom: 1px solid #eee; padding: 10px 0; display: flex; justify-content: space-between; align-items: center; }
        .kat-btn { display: block; padding: 8px; text-decoration: none; color: #333; border-radius: 5px; margin-bottom: 5px; }
        .kat-btn:hover, .kat-btn.active { background: #007bff; color: white; }
        button { cursor: pointer; border: none; border-radius: 4px; padding: 5px 10px; }
        .btn-add { background: #28a745; color: white; }
        .btn-buy { background: #007bff; color: white; width: 100%; padding: 15px; margin-top: 10px; font-weight: bold; }
        .alert { grid-column: 1 / span 3; background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; text-align: center; }
        input[type="text"] { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
    </style>
</head>
<body>
<?php if ($komunikat): ?>
    <div class="alert"><?php echo $komunikat; ?></div>
<?php endif; ?>

<div class="panel">
    <h3>Kategorie</h3>
    <a href="?" class="kat-btn <?php echo !$wybranaKat ? 'active' : ''; ?>">Wszystkie</a>
    <?php foreach ($wszystkieKategorie as $kat): ?>
        <a href="?kat=<?php echo $kat; ?>&szukaj=<?php echo $szukaj; ?>" 
           class="kat-btn <?php echo $wybranaKat === $kat ? 'active' : ''; ?>">
           <?php echo $kat; ?>
        </a>
    <?php endforeach; ?>
</div>

<div class="panel scroll">
    <form method="GET">
        <input type="hidden" name="kat" value="<?php echo $wybranaKat; ?>">
        <input type="text" name="szukaj" placeholder="Szukaj produktu..." value="<?php echo htmlspecialchars($szukaj); ?>">
        <button type="submit" style="width: 100%; background: #666; color: white;">Filtruj</button>
    </form>
    
    <h3>Produkty (<?php echo count($filtrowanaOferta); ?>)</h3>
    <?php foreach ($filtrowanaOferta as $p): ?>
        <div class="produkt">
            <div>
                <strong><?php echo $p->nazwa; ?></strong><br>
                <small><?php echo $p->cena; ?> <?php echo WALUTA; ?> | <?php echo $p->kategoria; ?></small>
            </div>
            <form method="POST">
                <button type="submit" name="dodaj_id" value="<?php echo $p->id; ?>" class="btn-add">Dodaj</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<div class="panel">
    <h3>Twój Koszyk</h3>
    <?php if (!empty($_SESSION['koszyk'])): ?>
        <div style="max-height: 300px; overflow-y: auto;">
            <?php foreach ($_SESSION['koszyk'] as $idx => $item): ?>
                <div style="font-size: 0.85em; margin-bottom: 8px; border-bottom: 1px dashed #ccc; padding-bottom: 4px;">
                    <?php echo $item->nazwa; ?> (<?php echo $item->cena; ?>)
                    <form method="POST" style="display:inline;">
                        <button type="submit" name="usun_indeks" value="<?php echo $idx; ?>" style="color:red; background:none; padding:0;">[x]</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <p>Netto: <?php echo number_format($koszykInfo->netto, 2); ?> <?php echo WALUTA; ?></p>
        <p>VAT (<?php echo VAT*100; ?>%): <?php echo number_format($koszykInfo->netto * VAT, 2); ?> <?php echo WALUTA; ?></p>
        <hr>
        <h4>Razem Brutto: <?php echo number_format($koszykInfo->brutto, 2); ?> <?php echo WALUTA; ?></h4>
        <form method="POST">
            <button type="submit" name="kupuj" class="btn-buy">ZAMÓW TERAZ</button>
        </form>
    <?php else: ?>
        <p>Twój koszyk jest pusty.</p>
    <?php endif; ?>
</div>

</body>
</html>