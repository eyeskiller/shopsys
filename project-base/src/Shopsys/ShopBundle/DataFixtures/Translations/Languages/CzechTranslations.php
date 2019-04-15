<?php

declare(strict_types = 1);

namespace Shopsys\ShopBundle\DataFixtures\Translations\Languages;

use Shopsys\ShopBundle\DataFixtures\Demo\AvailabilityDataFixture;
use Shopsys\ShopBundle\DataFixtures\Demo\CategoryDataFixture;
use Shopsys\ShopBundle\DataFixtures\Translations\DataFixturesTranslationInterface;
use Shopsys\ShopBundle\DataFixtures\Translations\DataFixturesTranslations;

class CzechTranslations implements DataFixturesTranslationInterface
{
    /**
     * @var array
     */
    private $translations = [];

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return 'cs';
    }

    /**
     * @return array
     */
    public function getTranslations(): array
    {
        if (empty($this->translations)) {
            $this->initTranslations();
        }

        return $this->translations;
    }

    protected function initTranslations(): void
    {
        $this->initAvailabilityTranslations();
        $this->initBrandTranslations();
        $this->initCategoryTranslations();
    }

    private function initAvailabilityTranslations(): void
    {
        $translationsAvailability = [
            DataFixturesTranslations::TRANSLATED_ATTRIBUTE_NAME => [
                AvailabilityDataFixture::AVAILABILITY_IN_STOCK => 'Skladem',
                AvailabilityDataFixture::AVAILABILITY_PREPARING => 'Připravujeme',
                AvailabilityDataFixture::AVAILABILITY_ON_REQUEST => 'Na dotaz',
                AvailabilityDataFixture::AVAILABILITY_OUT_OF_STOCK => 'Nedostupné',
            ],
        ];

        $this->translations[DataFixturesTranslations::TRANSLATED_ENTITY_AVAILABILITY] = $translationsAvailability;
    }

    private function initBrandTranslations(): void
    {
        $translationsBrand = [
            DataFixturesTranslations::TRANSLATED_ATTRIBUTE_DESCRIPTION => 'Toto je popis značky %s.',
        ];

        $this->translations[DataFixturesTranslations::TRANSLATED_ENTITY_BRAND] = $translationsBrand;
    }

    private function initCategoryTranslations(): void
    {
        $translationsCategory = [];

        $translationsCategory[DataFixturesTranslations::TRANSLATED_ATTRIBUTE_NAME] = [
            CategoryDataFixture::CATEGORY_ELECTRONICS => 'Elektro',
            CategoryDataFixture::CATEGORY_TV => 'Televize, audio',
            CategoryDataFixture::CATEGORY_PHOTO => 'Fotoaparáty',
            CategoryDataFixture::CATEGORY_PRINTERS => 'Tiskárny',
            CategoryDataFixture::CATEGORY_PC => 'Počítače & příslušenství',
            CategoryDataFixture::CATEGORY_PHONES => 'Mobilní telefony',
            CategoryDataFixture::CATEGORY_COFFEE => 'Kávovary',
            CategoryDataFixture::CATEGORY_BOOKS => 'Knihy',
            CategoryDataFixture::CATEGORY_TOYS => 'Hračky a další',
            CategoryDataFixture::CATEGORY_GARDEN_TOOLS => 'Zahradní náčiní',
            CategoryDataFixture::CATEGORY_FOOD => 'Jídlo',
        ];

        $translationsCategory[DataFixturesTranslations::TRANSLATED_ATTRIBUTE_DESCRIPTION] = [
            CategoryDataFixture::CATEGORY_ELECTRONICS => 'Naše elektronika zahrnuje zařízení určeno pro zábavu (televize s plochou obrazovkou, DVD přehrávače, DVD filmy, iPody, '
                . 'PC hry, auta na dálkové ovládání, atd.), pro komunikaci (telefony, mobilní telefony, notebooky, atd.) '
                . 'a pro kancelář (např., stolní počítače, tiskárny, skartovačky, atd.).',
            CategoryDataFixture::CATEGORY_TV => 'Televize nebo TV je telekomunikační zařízení, které se používá pro přenos zvuku s pohyblivými obrázky v monochromatickém '
                . '(černo-bílém), nebo barevném provedení, a ve dvouch nebo ve třech rozměrech.',
            CategoryDataFixture::CATEGORY_PHOTO => 'Fotoaparát je optické zařízení určeno pro nahrávání a zachytávaní obrazu, který může být uložen lokálně, '
                . 'přenášen na jiné umístění, nebo obojí.',
            CategoryDataFixture::CATEGORY_PRINTERS => 'Tiskárna je periferní zařízení, které umožňuje trvale přenést '
                . 'grafický a textový obsah na papír nebo podobné médium '
                . 'a to ve formě, která je srozumitelná i pro člověka.',
            CategoryDataFixture::CATEGORY_PC => 'Osobní počítač (PC) je zařízení s využitím pro různé účely, kterého velikost '
                . 'široké možnosti použití, prodejní cena, umožňují využití i pro jednotlivce a může být ovládán přímo '
                . 'koncovým uživatelem.',
            CategoryDataFixture::CATEGORY_PHONES => 'Telefon je komunikační zařízení, které umožňuje dvěma nebo více uživatelů provádět konverzaci '
                . 'a to i v případě, že jsou od sebe příliš vzdálení na to, aby mohli komunikovat přímo. Telefon převádí zvuk, '
                . 'typicky právě lidský hlas, na elektronické signály, které jsou vhodné pro přenos prostřednictvím '
                . 'kabelů nebo jiného přenosného média, a to i na velké vzdálenosti. Tyto signály jsou nakonec '
                . 'přehrány ve zvukové podobě koncovému uživateli.',
            CategoryDataFixture::CATEGORY_COFFEE => 'Kávovary jsou spotřebiče, které jsou určeny na vaření kávy. '
                . 'Existuje mnoho druhů kávovarů, v mnoha provedeních, které využívají různé principy přípravy kávy, '
                . 've většině případů jsou kávová zrna umístěny do papírového nebo kovového filtru uvnitř trychtýře. '
                . 'Pod tímto trychtýřem je skleněná nebo keramická konvice.',
            CategoryDataFixture::CATEGORY_BOOKS => 'Kniha je svazek psaných, tištěných, ilustrovaných, nebo prázdných listů, '
                . 'a je může být tvořena z papíru, atramentu, pergamenu, nebo z dalších materiálů, které jsou dokupy slepeny '
                . 'na jedné straně. Každý arch v knize je listem a současně na každé straně listu je jedna stránka.',
            CategoryDataFixture::CATEGORY_TOYS => 'Hračka je předmět, který může být využitý pro zábavu a hraní. '
                . 'S hračkami si hrají především děti a zvířatka. Hry s využitím hraček slouží často i pro '
                . 'učení dětí zábavnou formou pro život ve společnosti. Na výrobu hraček se používají různé materiály.',
            CategoryDataFixture::CATEGORY_GARDEN_TOOLS => 'Zahradní nářadí je jedním z mnoha nástrojů pro zahradu a '
                . 'zahradnictví a překrývá se s řadou nástrojů pro zemědělství a zahradnictví. Zahradní nářadí může '
                . 'být také ruční nářadí a elektrické nářadí.',
            CategoryDataFixture::CATEGORY_FOOD => 'Jídlo je jakákoliv látka spotřebovaná k zajištění nutriční podpory '
                . 'těla. Obvykle je rostlinného nebo živočišného původu a obsahuje základní živiny, jako jsou tuky, '
                . 'bílkoviny, vitamíny nebo minerály. Látka je přijímána organismem a buňkami organismu spotřebována, '
                . 's účelem zajištění energie.',
        ];

        $this->translations[DataFixturesTranslations::TRANSLATED_ENTITY_CATEGORY] = $translationsCategory;
    }
}