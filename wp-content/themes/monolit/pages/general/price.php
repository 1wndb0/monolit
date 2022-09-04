<?php
$title = get_field('price_title', 'options');
$list = get_field('price_list', 'options');
$number = 0;
?>

<section class="article_main">
    <div class="container">
        <?php getField($title, 'services_main_title', 'h1'); ?>
        <?php if (!empty($list)): ?>
            <div class="article_content">
                <table style="border-collapse: collapse; width: 1007.33px; height: 616px; background-color: #f3f3f3; border-color: #ced4d9; border-style: dotted; margin-left: auto; margin-right: auto;"
                       border="1" data-darkreader-inline-bgcolor="" data-darkreader-inline-border-top="" data-darkreader-inline-border-right="" data-darkreader-inline-border-bottom=""
                       data-darkreader-inline-border-left="">
                    <tbody>
                    <?php foreach ($list as $index => $item): ?>
                        <?php if (!empty($item['break_line'])): ?>
                            <tr style="height: 22px;">
                                <td style="width: 718px; text-align: center; height: 22px;" colspan="2">
                                    <strong>
                                        <span style="color: #3598db;" data-darkreader-inline-color="">
                                            <?php echo $item['title'] ?>
                                        </span>
                                    </strong>
                                </td>
                                <td style="width: 116px; height: 22px;"><strong style="text-align: center;"><?php echo $item['price'] ?></strong></td>
                                <td style="width: 116px; height: 22px;"></td>
                            </tr>
                            <?php $number = 0;
                        elseif ($index === 0): ?>
                            <tr style="height: 22px;">
                                <th style="width: 36px; height: 22px; text-align: center;" scope="row"><strong>№</strong></th>
                                <td style="width: 682px; height: 22px; text-align: center;"><strong><?php echo $item['title'] ?></strong></td>
                                <td style="width: 116px; height: 22px; text-align: center;"><strong><?php echo $item['price'] ?></strong></td>
                                <td style="width: 116px; height: 22px; text-align: center;"><strong><?php echo $item['for'] ?></strong></td>
                            </tr>
                        <?php else: ?>
                            <tr style="height: 22px;">
                                <td style="width: 36px; height: 22px; text-align: center;" scope="row"><?php echo $number; ?></td>
                                <td style="width: 682px; height: 22px; text-align: center;"><?php echo $item['title'] ?></td>
                                <td style="width: 116px; height: 22px; text-align: center;"><?php echo $item['price'] ?></td>
                                <td style="width: 116px; height: 22px; text-align: center;">    <?php echo $item['for'] ?></td>
                            </tr>
                        <?php endif;
                        $number++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>