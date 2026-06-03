<div class="calculator">
    <h2>Калькулятор индекса массы тела (ИМТ)</h2>
    <form action="/calculator" method="GET">
        <div class="form-group">
            <label for="height">Рост (см)</label>
            <input type="number" step="1" name="height" id="height" value="<?php echo $height; ?>" required>
        </div>
        <div class="form-group">
            <label for="weight">Вес (кг)</label>
            <input type="number" step="0.1" name="weight" id="weight" value="<?php echo $weight; ?>" required>
        </div>
        <button type="submit">Рассчитать</button>
    </form>

    <?php if ($result !== null): ?>
        <div class="result">
            <h3>Ваш ИМТ: <?php echo $result['bmi']; ?></h3>
            <p>Интерпретация: <?php echo $result['interpret']; ?></p>
        </div>
    <?php endif; ?>
</div>