<?
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array( 'label'  => 'Título' ))
            ->add('body', 'textarea', array( 'label'  => 'Contenido' ))
            ->add('published', 'checkbox', array( 'label'  => 'Publicado', 'required' => false))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Post'
        ));
    }

    public function getName()
    {
        return 'post';
    }
}