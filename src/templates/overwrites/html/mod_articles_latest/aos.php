<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Load FieldsHelper
JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');

// Generate Random-ID to create unique identifier for Tiny-Slider-Setup
$randomId = substr(md5(uniqid()), 0, 12);;

if (!$list)
{
    return;
}

?>
<div class="latestarticlesaos">
    <?php foreach ($list as $item) : ?>
        <?php
        $item->jcfields = FieldsHelper::getFields('com_content.article', $item, true);

        foreach($item->jcfields as $jcfield)
        {
            $item->jcfields[$jcfield->name] = $jcfield;
        }
        ?>

        <div class="latestarticlesaos__item" data-aos="<?php echo $item->jcfields['animationsstil']->rawvalue[0]; ?>" itemscope itemtype="https://schema.org/Article">
            <h2 class="latestarticlesaos__item-title"><?php echo $item->title; ?></h2>
            <div class="latestarticlesaos__item-intro">
                <?php echo $item->introtext; ?>
            </div>
            <a class="latestarticlesaos__item-readmore btn btn--primary" href="<?php echo $item->link; ?>" class="latestarticleslider__item-upper">
                <?php echo JText::_('COM_CONTENT_READ_MORE'); ?>
            </a>
        </div>
    <?php endforeach; ?>
</div>