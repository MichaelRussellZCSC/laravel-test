<html>
<head>
    <style>
        .board .row {
            width: 24em;
            display: flex;
        }

        .board .row > div {
            width: 3em;
            height: 3em;
        }

        .board .white {
            background-color: #c2c2c2;
        }

        .board .black {
            background-color: #525252;
        }

    </style>
</head>
<body>
<div class="board">
    <?php for($i = 0; $i < 8; $i++): ?>
        <div class="row">

            <?php for($j = 0; $j < 8; $j++): ?>

                <div class="<?php echo ($j + $i) % 2 == 0 ? 'white' : 'black' ?>">
                    <?php if($i == 3 && $j == 1): ?>
                        <img src="http://classes.codingbootcamp.cz/assets/classes/33/pieces/whites/king.png" alt="">
                    <?php endif; ?>
                </div>

            <?php endfor; ?>

        </div>
    <?php endfor; ?>
</div>
</body>
</html>
