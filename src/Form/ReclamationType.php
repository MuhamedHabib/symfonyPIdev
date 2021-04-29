<?php /** @noinspection PhpUndefinedNamespaceInspection */

/** @noinspection PhpUndefinedClassInspection */

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;


class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class,[
                'choices'=> array(
                    'Contenu'=>'Contenu',
                    'Service technique'=>'ServiceTechnique',

                )
            ])

            ->add('text', TextareaType::class,[
                            'label'=>'Description',
                'attr'=>[
        'placeholder'=>'Description',
    ]
            ])

            ->add('screenshot', FileType::class, [
                'label'=>'Image',
                'mapped'=> false,
                'required' => false

            ])

            ->add('object', TextType::class,[
                'label'=>'sujet',
                'attr'=>[
                    'placeholder'=>'sujet',
                ]
            ])

            ->add('captchaCode', CaptchaType::class, array(
                'captchaConfig' => 'ExampleCaptchaUserRegistration',
                'constraints' => [
                    new ValidCaptcha([
                        'message' => 'Invalid captcha, please try again',
                    ]),
                ],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
