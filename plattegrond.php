<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./js/script.js" defer></script>
    <title>Plattegrond</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="./styles/styling-v2.css">
</head>
<body onload="javascript:insertBlueprintLinks();">
    
    <?php require_once 'includes/header.php'; ?>
    <main id="plattegrond_main">
    <div class="grid-container">
        <!-- Row 1 -->
        <div class="blueprint-title white">Toren A</div>
        <div class="blueprint-title blueprint-hallway white">Gang A naar B</div>
        <div class="blueprint-title white">Toren B</div>
        <div class="blueprint-title blueprint-hallway white">Gang B naar C</div>
        <div class="blueprint-title white">Toren C</div>
    
        <a href="#" class="blueprint-cell red">10</a>
        <a href="#" class="blueprint-cell blueprint-hallway white"></a>
        <a href="#" class="blueprint-cell white"></a>
        <a href="#" class="blueprint-cell blueprint-hallway white"></a>
        <a href="#" class="blueprint-cell white"></a>
    
        <a href="#" class="blueprint-cell red">9</a>
        <a href="#" class="blueprint-cell blueprint-hallway pink">9</a>
        <a href="#" class="blueprint-cell purple">9</a>
        <a href="#" class="blueprint-cell blueprint-hallway white"></a>
        <a href="#" class="blueprint-cell white"></a>
    
        <!-- Row 2 -->
        <a href="#" class="blueprint-cell red">8</a>
        <a href="#" class="blueprint-cell blueprint-hallway pink">8</a>
        <a href="#" class="blueprint-cell purple">8</a>
        <a href="#" class="blueprint-cell blueprint-hallway cyan">8</a>
        <a href="#" class="blueprint-cell green">8</a>
    
        <!-- Additional rows here -->
        <a href="#" class="blueprint-cell red">7</a>
        <a href="#" class="blueprint-cell blueprint-hallway pink">7</a>
        <a href="#" class="blueprint-cell purple">7</a>
        <a href="#" class="blueprint-cell blueprint-hallway cyan">7</a>
        <a href="#" class="blueprint-cell green">7</a>
    
        <a href="#" class="blueprint-cell red">6</a>
        <a href="#" class="blueprint-cell blueprint-hallway pink">6</a>
        <a href="#" class="blueprint-cell purple">6</a>
        <a href="#" class="blueprint-cell blueprint-hallway cyan">6</a>
        <a href="#" class="blueprint-cell green">6</a>
    
        <a href="#" class="blueprint-cell red">5</a>
        <a href="#" class="blueprint-cell blueprint-hallway white"></a>
        <a href="#" class="blueprint-cell purple">5</a>
        <a href="#" class="blueprint-cell blueprint-hallway cyan">5</a>
        <a href="#" class="blueprint-cell green">5</a>
    
        <a href="#" class="blueprint-cell red">4</a>
        <a href="#" class="blueprint-cell blueprint-hallway white"></a>
        <a href="#" class="blueprint-cell purple">4</a>
        <a href="#" class="blueprint-cell blueprint-hallway cyan">4</a>
        <a href="#" class="blueprint-cell green">4</a>
    
        <a href="#" class="blueprint-cell red">3</a>
        <a href="#" class="blueprint-cell blueprint-hallway white"></a>
        <a href="#" class="blueprint-cell purple">3</a>
        <a href="#" class="blueprint-cell blueprint-hallway cyan">3</a>
        <a href="#" class="blueprint-cell green">3</a>
    
        <a href="#" class="blueprint-cell red">2</a>
        <a href="#" class="blueprint-cell blueprint-hallway white"></a>
        <a href="#" class="blueprint-cell purple">2</a>
        <a href="#" class="blueprint-cell blueprint-hallway white"></a>
        <a href="#" class="blueprint-cell green">2</a>
    
        <a href="#" class="blueprint-cell red">1</a>
        <a href="#" class="blueprint-cell blueprint-hallway white"></a>
        <a href="#" class="blueprint-cell purple">1</a>
        <a href="#" class="blueprint-cell blueprint-hallway white"></a>
        <a href="#" class="blueprint-cell green">1</a>
    
        <a href="#" class="blueprint-cell red">E</a>
        <a href="#" class="blueprint-cell blueprint-hallway pink">E</a>
        <a href="#" class="blueprint-cell purple">E</a>
        <a href="#" class="blueprint-cell blueprint-hallway cyan">E</a>
        <a href="#" class="blueprint-cell green">E</a>
    
        <a href="#" class="blueprint-cell red">-1</a>
        <a href="#" class="blueprint-cell blueprint-hallway pink">-1</a>
        <a href="#" class="blueprint-cell purple">-1</a>
        <a href="#" class="blueprint-cell blueprint-hallway cyan">-1</a>
        <a href="#" class="blueprint-cell green">-1</a>
    </div>    
    </main>

    <?php require_once 'includes/footer.php' ?>
    
</body>
</html>