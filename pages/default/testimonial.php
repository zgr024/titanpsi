    <div class="testimonial">
        <div class="photo">
<?
        if ($t[1]) {
?>
            <img src="<?=$t[1]?>" alt="" />
<?
        }
?>
        </div>
        <div class="block">
            <div class="contact">
                <div class="name">
                    <?=$t[0]?>
                </div>
<?
        if ($t[4]) {
?>
                <a href="<?=$t[4]?>" class="linkedin" target="_blank"></a>
<?
        }
?>
            </div>
            <div class="title">
                <?=$t[2]?>
            </div>
            <div class="statement">
                <?=$t[3]?>
            </div>
        </div>
    </div>