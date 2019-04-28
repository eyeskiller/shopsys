<?php

namespace Shopsys\ShopBundle\DataFixtures\Demo;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Shopsys\FrameworkBundle\Component\DataFixture\AbstractReferenceFixture;
use Shopsys\FrameworkBundle\Component\Money\Money;
use Shopsys\FrameworkBundle\Model\Payment\PaymentData;
use Shopsys\FrameworkBundle\Model\Payment\PaymentDataFactoryInterface;
use Shopsys\FrameworkBundle\Model\Payment\PaymentFacade;
use Shopsys\ShopBundle\DataFixtures\Translations\DataFixturesTranslations;

class PaymentDataFixture extends AbstractReferenceFixture implements DependentFixtureInterface
{
    const PAYMENT_CARD = 'payment_card';
    const PAYMENT_CASH_ON_DELIVERY = 'payment_cash_on_delivery';
    const PAYMENT_CASH = 'payment_cash';

    /** @var \Shopsys\FrameworkBundle\Model\Payment\PaymentFacade */
    protected $paymentFacade;

    /**
     * @var \Shopsys\FrameworkBundle\Model\Payment\PaymentDataFactoryInterface
     */
    protected $paymentDataFactory;

    /**
     * @var \Shopsys\ShopBundle\DataFixtures\Translations\DataFixturesTranslations
     */
    private $dataFixturesTranslations;

    /**
     * @param \Shopsys\FrameworkBundle\Model\Payment\PaymentFacade $paymentFacade
     * @param \Shopsys\FrameworkBundle\Model\Payment\PaymentDataFactoryInterface $paymentDataFactory
     * @param \Shopsys\ShopBundle\DataFixtures\Translations\DataFixturesTranslations $dataFixturesTranslations
     */
    public function __construct(
        PaymentFacade $paymentFacade,
        PaymentDataFactoryInterface $paymentDataFactory,
        DataFixturesTranslations $dataFixturesTranslations
    ) {
        $this->paymentFacade = $paymentFacade;
        $this->paymentDataFactory = $paymentDataFactory;
        $this->dataFixturesTranslations = $dataFixturesTranslations;
    }

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $paymentData = $this->paymentDataFactory->create();
        $paymentData->name = $this->dataFixturesTranslations->getEntityAttributeTranslationsByReferenceName(
            DataFixturesTranslations::TRANSLATED_ENTITY_PAYMENT,
            DataFixturesTranslations::TRANSLATED_ATTRIBUTE_NAME,
            self::PAYMENT_CARD
        );
        $paymentData->pricesByCurrencyId = [
            $this->getReference(CurrencyDataFixture::CURRENCY_CZK)->getId() => Money::create('99.95'),
            $this->getReference(CurrencyDataFixture::CURRENCY_EUR)->getId() => Money::create('2.95'),
        ];
        $paymentData->description = $this->dataFixturesTranslations->getEntityAttributeTranslationsByReferenceName(
            DataFixturesTranslations::TRANSLATED_ENTITY_PAYMENT,
            DataFixturesTranslations::TRANSLATED_ATTRIBUTE_DESCRIPTION,
            self::PAYMENT_CARD
        );
        $paymentData->instructions = $this->dataFixturesTranslations->getEntityAttributeTranslationsByReferenceName(
            DataFixturesTranslations::TRANSLATED_ENTITY_PAYMENT,
            DataFixturesTranslations::TRANSLATED_ATTRIBUTE_INSTRUCTIONS,
            self::PAYMENT_CARD
        );
        $paymentData->vat = $this->getReference(VatDataFixture::VAT_ZERO);
        $this->createPayment(self::PAYMENT_CARD, $paymentData, [
            TransportDataFixture::TRANSPORT_PERSONAL,
            TransportDataFixture::TRANSPORT_PPL,
        ]);

        $paymentData = $this->paymentDataFactory->create();
        $paymentData->name = $this->dataFixturesTranslations->getEntityAttributeTranslationsByReferenceName(
            DataFixturesTranslations::TRANSLATED_ENTITY_PAYMENT,
            DataFixturesTranslations::TRANSLATED_ATTRIBUTE_NAME,
            self::PAYMENT_CASH_ON_DELIVERY
        );
        $paymentData->pricesByCurrencyId = [
            $this->getReference(CurrencyDataFixture::CURRENCY_CZK)->getId() => Money::create('49.90'),
            $this->getReference(CurrencyDataFixture::CURRENCY_EUR)->getId() => Money::create('1.95'),
        ];
        $paymentData->vat = $this->getReference(VatDataFixture::VAT_HIGH);
        $this->createPayment(self::PAYMENT_CASH_ON_DELIVERY, $paymentData, [TransportDataFixture::TRANSPORT_CZECH_POST]);

        $paymentData = $this->paymentDataFactory->create();
        $paymentData->name = $this->dataFixturesTranslations->getEntityAttributeTranslationsByReferenceName(
            DataFixturesTranslations::TRANSLATED_ENTITY_PAYMENT,
            DataFixturesTranslations::TRANSLATED_ATTRIBUTE_NAME,
            self::PAYMENT_CASH
        );
        $paymentData->czkRounding = true;
        $paymentData->pricesByCurrencyId = [
            $this->getReference(CurrencyDataFixture::CURRENCY_CZK)->getId() => Money::zero(),
            $this->getReference(CurrencyDataFixture::CURRENCY_EUR)->getId() => Money::zero(),
        ];
        $paymentData->vat = $this->getReference(VatDataFixture::VAT_HIGH);
        $this->createPayment(self::PAYMENT_CASH, $paymentData, [TransportDataFixture::TRANSPORT_PERSONAL]);
    }

    /**
     * @param string $referenceName
     * @param \Shopsys\FrameworkBundle\Model\Payment\PaymentData $paymentData
     * @param array $transportsReferenceNames
     */
    protected function createPayment(
        $referenceName,
        PaymentData $paymentData,
        array $transportsReferenceNames
    ) {
        $paymentData->transports = [];
        foreach ($transportsReferenceNames as $transportReferenceName) {
            $paymentData->transports[] = $this->getReference($transportReferenceName);
        }

        $payment = $this->paymentFacade->create($paymentData);
        $this->addReference($referenceName, $payment);
    }

    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        return [
            TransportDataFixture::class,
            VatDataFixture::class,
            CurrencyDataFixture::class,
        ];
    }
}
