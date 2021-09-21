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

if (!$list)
{
	return;
}

?>
<ul class="latestarticleslider">
<?php foreach ($list as $item) : ?>
    // Register Fields
    <?php
        $item->jcfields = FieldsHelper::getFields('com_content.article', $item, true);

        foreach($item->jcfields as $jcfield)
        {
            $item->jcfields[$jcfield->name] = $jcfield;
        }
    ?>
	<li class="latestarticleslider__item" itemscope itemtype="https://schema.org/Article">
        <a href="<?php echo $item->link; ?>" class="latestarticleslider__item-upper">
            <h2 itemprop="name" class="latestarticleslider__item-upper-title"><?php echo $item->title; ?></h2>
            <img class="latestarticleslider__item-upper-image" loading="lazy" src="pfad-zum-introbild.jpg" />
        </a>
        <div class="latestarticleslider__item-lower">
            <span class="latestarticleslider__item-lower-client">
                Kundenname
            </span>
            <span class="latestarticleslider__item-lower-client">
                Projektabschluss-Datum
            </span>
        </div>
	</li>
<?php endforeach; ?>
</ul>
