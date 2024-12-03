<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plattegrond</title>
</head>
<body>
    
    <?php require_once 'includes/header.php'; ?>
    <main id="plattegrond_main">
        <svg width="425" height="400" xmlns="http://www.w3.org/2000/svg">
            <!-- Define the grid dimensions -->
            <rect width="425" height="400" fill="white"/>
          
            <!-- Toren A -->
            <rect x="0" y="0" width="60" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="30" y="20" font-size="12" text-anchor="middle" fill="black">Toren A</text>

            <!-- Floor 10 -->
            <a href="melding_aanmaken.php?tower=A&floor=10">
                <rect x="0" y="30" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="50" font-size="12" text-anchor="middle" fill="black">10</text>
            </a>

            <!-- Floor 9 -->
            <a href="melding_aanmaken.php?tower=A&floor=9">
                <rect x="0" y="60" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="80" font-size="12" text-anchor="middle" fill="black">9</text>
            </a>

            <!-- Floor 8 -->
            <a href="melding_aanmaken.php?tower=A&floor=8">
                <rect x="0" y="90" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="110" font-size="12" text-anchor="middle" fill="black">8</text>
            </a>

            <!-- Floor 7 -->
            <a href="melding_aanmaken.php?tower=A&floor=7">
                <rect x="0" y="120" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="140" font-size="12" text-anchor="middle" fill="black">7</text>
            </a>

            <!-- Floor 6 -->
            <a href="melding_aanmaken.php?tower=A&floor=6">
                <rect x="0" y="150" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="170" font-size="12" text-anchor="middle" fill="black">6</text>
            </a>

            <!-- Floor 5 -->
            <a href="melding_aanmaken.php?tower=A&floor=5">
                <rect x="0" y="180" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="200" font-size="12" text-anchor="middle" fill="black">5</text>
            </a>

            <!-- Floor 4 -->
            <a href="melding_aanmaken.php?tower=A&floor=4">
                <rect x="0" y="210" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="230" font-size="12" text-anchor="middle" fill="black">4</text>
            </a>

            <!-- Floor 3 -->
            <a href="melding_aanmaken.php?tower=A&floor=3">
                <rect x="0" y="240" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="260" font-size="12" text-anchor="middle" fill="black">3</text>
            </a>

            <!-- Floor 2 -->
            <a href="melding_aanmaken.php?tower=A&floor=2">
                <rect x="0" y="270" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="290" font-size="12" text-anchor="middle" fill="black">2</text>
            </a>

            <!-- Floor 1 -->
            <a href="melding_aanmaken.php?tower=A&floor=1">
                <rect x="0" y="300" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="320" font-size="12" text-anchor="middle" fill="black">1</text>
            </a>

            <!-- Floor E -->
            <a href="melding_aanmaken.php?tower=A&floor=E">
                <rect x="0" y="330" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="350" font-size="12" text-anchor="middle" fill="black">E</text>
            </a>

            <!-- Ground Floor (0) -->
            <a href="melding_aanmaken.php?tower=A&floor=0">
                <rect x="0" y="360" width="60" height="30" fill="Red" stroke="black" stroke-width="1"/>
                <text x="30" y="380" font-size="12" text-anchor="middle" fill="black">0</text>
            </a>


          
            <!-- A - B -->
            <rect x="60" y="0" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="120" y="20" font-size="12" text-anchor="middle" fill="black">A - B</text>

            <!-- Empty row -->
            <rect x="60" y="30" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="120" y="50" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Floor 9 -->
            <a href="melding_aanmaken.php?tower=A-B&floor=9">
                <rect x="60" y="60" width="120" height="30" fill="Pink" stroke="black" stroke-width="1"/>
                <text x="120" y="80" font-size="12" text-anchor="middle" fill="black">9</text>
            </a>

            <!-- Floor 8 -->
            <a href="melding_aanmaken.php?tower=A-B&floor=8">
                <rect x="60" y="90" width="120" height="30" fill="Pink" stroke="black" stroke-width="1"/>
                <text x="120" y="110" font-size="12" text-anchor="middle" fill="black">8</text>
            </a>

            <!-- Floor 7 -->
            <a href="melding_aanmaken.php?tower=A-B&floor=7">
                <rect x="60" y="120" width="120" height="30" fill="Pink" stroke="black" stroke-width="1"/>
                <text x="120" y="140" font-size="12" text-anchor="middle" fill="black">7</text>
            </a>

            <!-- Floor 6 -->
            <a href="melding_aanmaken.php?tower=A-B&floor=6">
                <rect x="60" y="150" width="120" height="30" fill="Pink" stroke="black" stroke-width="1"/>
                <text x="120" y="170" font-size="12" text-anchor="middle" fill="black">6</text>
            </a>

            <!-- Empty row -->
            <rect x="60" y="180" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="120" y="200" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Empty row -->
            <rect x="60" y="210" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="120" y="230" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Empty row -->
            <rect x="60" y="240" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="120" y="260" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Empty row -->
            <rect x="60" y="270" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="120" y="290" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Empty row -->
            <rect x="60" y="300" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="120" y="320" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Floor E -->
            <a href="melding_aanmaken.php?tower=A-B&floor=E">
                <rect x="60" y="330" width="120" height="30" fill="Pink" stroke="black" stroke-width="1"/>
                <text x="120" y="350" font-size="12" text-anchor="middle" fill="black">E</text>
            </a>

            <!-- Ground Floor (0) -->
            <a href="melding_aanmaken.php?tower=A-B&floor=0">
                <rect x="60" y="360" width="120" height="30" fill="Pink" stroke="black" stroke-width="1"/>
                <text x="120" y="380" font-size="12" text-anchor="middle" fill="black">0</text>
            </a>

          

            <!-- Toren B -->
            <rect x="180" y="0" width="60" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="210" y="20" font-size="12" text-anchor="middle" fill="black">Toren B</text>

            <!-- Empty row -->
            <rect x="180" y="30" width="60" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="210" y="50" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Floor 9 -->
            <a href="melding_aanmaken.php?tower=B&floor=9">
                <rect x="180" y="60" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="80" font-size="12" text-anchor="middle" fill="black">9</text>
            </a>

            <!-- Floor 8 -->
            <a href="melding_aanmaken.php?tower=B&floor=8">
                <rect x="180" y="90" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="110" font-size="12" text-anchor="middle" fill="black">8</text>
            </a>

            <!-- Floor 7 -->
            <a href="melding_aanmaken.php?tower=B&floor=7">
                <rect x="180" y="120" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="140" font-size="12" text-anchor="middle" fill="black">7</text>
            </a>

            <!-- Floor 6 -->
            <a href="melding_aanmaken.php?tower=B&floor=6">
                <rect x="180" y="150" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="170" font-size="12" text-anchor="middle" fill="black">6</text>
            </a>

            <!-- Floor 5 -->
            <a href="melding_aanmaken.php?tower=B&floor=5">
                <rect x="180" y="180" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="200" font-size="12" text-anchor="middle" fill="black">5</text>
            </a>

            <!-- Floor 4 -->
            <a href="melding_aanmaken.php?tower=B&floor=4">
                <rect x="180" y="210" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="230" font-size="12" text-anchor="middle" fill="black">4</text>
            </a>

            <!-- Floor 3 -->
            <a href="melding_aanmaken.php?tower=B&floor=3">
                <rect x="180" y="240" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="260" font-size="12" text-anchor="middle" fill="black">3</text>
            </a>

            <!-- Floor 2 -->
            <a href="melding_aanmaken.php?tower=B&floor=2">
                <rect x="180" y="270" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="290" font-size="12" text-anchor="middle" fill="black">2</text>
            </a>

            <!-- Floor 1 -->
            <a href="melding_aanmaken.php?tower=B&floor=1">
                <rect x="180" y="300" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="320" font-size="12" text-anchor="middle" fill="black">1</text>
            </a>

            <!-- Floor E -->
            <a href="melding_aanmaken.php?tower=B&floor=E">
                <rect x="180" y="330" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="350" font-size="12" text-anchor="middle" fill="black">E</text>
            </a>

            <!-- Ground Floor (0) -->
            <a href="melding_aanmaken.php?tower=B&floor=0">
                <rect x="180" y="360" width="60" height="30" fill="Purple" stroke="black" stroke-width="1"/>
                <text x="210" y="380" font-size="12" text-anchor="middle" fill="black">0</text>
            </a>

          

            <!-- B - C -->
            <rect x="240" y="0" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="300" y="20" font-size="12" text-anchor="middle" fill="black">B - C</text>

            <!-- Empty row -->
            <rect x="240" y="30" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="300" y="50" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Empty row -->
            <rect x="240" y="60" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="300" y="80" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Floor 8 -->
            <a href="melding_aanmaken.php?tower=B-C&floor=8">
                <rect x="240" y="90" width="120" height="30" fill="Cyan" stroke="black" stroke-width="1"/>
                <text x="300" y="110" font-size="12" text-anchor="middle" fill="black">8</text>
            </a>

            <!-- Floor 7 -->
            <a href="melding_aanmaken.php?tower=B-C&floor=7">
                <rect x="240" y="120" width="120" height="30" fill="Cyan" stroke="black" stroke-width="1"/>
                <text x="300" y="140" font-size="12" text-anchor="middle" fill="black">7</text>
            </a>

            <!-- Floor 6 -->
            <a href="melding_aanmaken.php?tower=B-C&floor=6">
                <rect x="240" y="150" width="120" height="30" fill="Cyan" stroke="black" stroke-width="1"/>
                <text x="300" y="170" font-size="12" text-anchor="middle" fill="black">6</text>
            </a>

            <!-- Floor 5 -->
            <a href="melding_aanmaken.php?tower=B-C&floor=5">
                <rect x="240" y="180" width="120" height="30" fill="Cyan" stroke="black" stroke-width="1"/>
                <text x="300" y="200" font-size="12" text-anchor="middle" fill="black">5</text>
            </a>

            <!-- Floor 4 -->
            <a href="melding_aanmaken.php?tower=B-C&floor=4">
                <rect x="240" y="210" width="120" height="30" fill="Cyan" stroke="black" stroke-width="1"/>
                <text x="300" y="230" font-size="12" text-anchor="middle" fill="black">4</text>
            </a>

            <!-- Floor 3 -->
            <a href="melding_aanmaken.php?tower=B-C&floor=3">
                <rect x="240" y="240" width="120" height="30" fill="Cyan" stroke="black" stroke-width="1"/>
                <text x="300" y="260" font-size="12" text-anchor="middle" fill="black">3</text>
            </a>

            <!-- Empty row -->
            <rect x="240" y="270" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="300" y="290" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Empty row -->
            <rect x="240" y="300" width="120" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="300" y="320" font-size="12" text-anchor="middle" fill="black"></text>

            <!-- Floor E -->
            <a href="melding_aanmaken.php?tower=B-C&floor=E">
                <rect x="240" y="330" width="120" height="30" fill="Cyan" stroke="black" stroke-width="1"/>
                <text x="300" y="350" font-size="12" text-anchor="middle" fill="black">E</text>
            </a>

            <!-- Ground Floor (0) -->
            <a href="melding_aanmaken.php?tower=B-C&floor=0">
                <rect x="240" y="360" width="120" height="30" fill="Cyan" stroke="black" stroke-width="1"/>
                <text x="300" y="380" font-size="12" text-anchor="middle" fill="black">0</text>
            </a>


          
            <!-- Toren C -->
            <rect x="360" y="0" width="60" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="390" y="20" font-size="12" text-anchor="middle" fill="black">Toren C</text>
            
            <!-- Empty row -->
            <rect x="360" y="30" width="60" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="390" y="50" font-size="12" text-anchor="middle" fill="black"></text>
            
            <!-- Empty row -->
            <rect x="360" y="60" width="60" height="30" fill="White" stroke="White" stroke-width="0"/>
            <text x="390" y="80" font-size="12" text-anchor="middle" fill="black"></text>
            
            <!-- Floor 8 -->
            <a href="melding_aanmaken.php?tower=C&floor=8">
                <rect x="360" y="90" width="60" height="30" fill="Green" stroke="black" stroke-width="1"/>
                <text x="390" y="110" font-size="12" text-anchor="middle" fill="black">8</text>
            </a>
            
            <!-- Floor 7 -->
            <a href="melding_aanmaken.php?tower=C&floor=7">
                <rect x="360" y="120" width="60" height="30" fill="Green" stroke="black" stroke-width="1"/>
                <text x="390" y="140" font-size="12" text-anchor="middle" fill="black">7</text>
            </a>
            
            <!-- Floor 6 -->
            <a href="melding_aanmaken.php?tower=C&floor=6">
                <rect x="360" y="150" width="60" height="30" fill="Green" stroke="black" stroke-width="1"/>
                <text x="390" y="170" font-size="12" text-anchor="middle" fill="black">6</text>
            </a>
            
            <!-- Floor 5 -->
            <a href="melding_aanmaken.php?tower=C&floor=5">
                <rect x="360" y="180" width="60" height="30" fill="Green" stroke="black" stroke-width="1"/>
                <text x="390" y="200" font-size="12" text-anchor="middle" fill="black">5</text>
            </a>
            
            <!-- Floor 4 -->
            <a href="melding_aanmaken.php?tower=C&floor=4">
                <rect x="360" y="210" width="60" height="30" fill="Green" stroke="black" stroke-width="1"/>
                <text x="390" y="230" font-size="12" text-anchor="middle" fill="black">4</text>
            </a>
            
            <!-- Floor 3 -->
            <a href="melding_aanmaken.php?tower=C&floor=3">
                <rect x="360" y="240" width="60" height="30" fill="Green" stroke="black" stroke-width="1"/>
                <text x="390" y="260" font-size="12" text-anchor="middle" fill="black">3</text>
            </a>
            
            <!-- Floor 2 -->
            <a href="melding_aanmaken.php?tower=C&floor=2">
                <rect x="360" y="270" width="60" height="30" fill="Green" stroke="black" stroke-width="1"/>
                <text x="390" y="290" font-size="12" text-anchor="middle" fill="black">2</text>
            </a>
            
            <!-- Floor 1 -->
            <a href="melding_aanmaken.php?tower=C&floor=1">
                <rect x="360" y="300" width="60" height="30" fill="Green" stroke="black" stroke-width="1"/>
                <text x="390" y="320" font-size="12" text-anchor="middle" fill="black">1</text>
            </a>
            
            <!-- Floor E -->
            <a href="melding_aanmaken.php?tower=C&floor=E">
                <rect x="360" y="330" width="60" height="30" fill="Green" stroke="black" stroke-width="1"/>
                <text x="390" y="350" font-size="12" text-anchor="middle" fill="black">E</text>
            </a>
            
            <!-- Ground Floor (0) -->
            <a href="melding_aanmaken.php?tower=C&floor=0">
                <rect x="360" y="360" width="60" height="30" fill="Green" stroke="black" stroke-width="1"/>
                <text x="390" y="380" font-size="12" text-anchor="middle" fill="black">0</text>
            </a>

        </svg>                    
    </main>

    <?php require_once 'includes/footer.php' ?>
    
</body>
</html>