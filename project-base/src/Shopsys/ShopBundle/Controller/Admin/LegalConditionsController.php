<?php

namespace Shopsys\ShopBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Shopsys\ShopBundle\Component\Controller\AdminBaseController;
use Shopsys\ShopBundle\Component\Domain\AdminDomainTabsFacade;
use Shopsys\ShopBundle\Component\Setting\Setting;
use Shopsys\ShopBundle\Form\Admin\LegalConditions\LegalConditionsSettingFormType;
use Shopsys\ShopBundle\Model\LegalConditions\LegalConditionsFacade;
use Symfony\Component\HttpFoundation\Request;

class LegalConditionsController extends AdminBaseController
{
    /**
     * @var \Shopsys\ShopBundle\Component\Domain\AdminDomainTabsFacade
     */
    private $adminDomainTabsFacade;

    /**
     * @var \Shopsys\ShopBundle\Model\LegalConditions\LegalConditionsFacade
     */
    private $legalConditionsFacade;

    public function __construct(
        AdminDomainTabsFacade $adminDomainTabsFacade,
        LegalConditionsFacade $legalConditionsFacade
    ) {
        $this->adminDomainTabsFacade = $adminDomainTabsFacade;
        $this->legalConditionsFacade = $legalConditionsFacade;
    }

    /**
     * @Route("/legal-conditions/setting/")
     */
    public function settingAction(Request $request)
    {
        $domainId = $this->adminDomainTabsFacade->getSelectedDomainId();
        $settingData = [
            'termsAndConditionsArticle' => $this->legalConditionsFacade->findTermsAndConditions($domainId),
            'privacyPolicyArticle' => $this->legalConditionsFacade->findPrivacyPolicy($domainId),
        ];

        $form = $this->createForm(LegalConditionsSettingFormType::class, $settingData, [
            'domain_id' => $domainId,
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $formData = $form->getData();

            $this->legalConditionsFacade->setTermsAndConditions($formData['termsAndConditionsArticle'], $domainId);
            $this->legalConditionsFacade->setPrivacyPolicy($formData['privacyPolicyArticle'], $domainId);

            $this->getFlashMessageSender()->addSuccessFlashTwig(t('Legal conditions settings modified.'));
            return $this->redirectToRoute('admin_legalconditions_setting');
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->getFlashMessageSender()->addErrorFlashTwig(t('Please check the correctness of all data filled.'));
        }

        return $this->render('@ShopsysShop/Admin/Content/LegalConditions/setting.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}