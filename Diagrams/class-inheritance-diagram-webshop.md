```mermaid
---
title: Class Inheritance Diagram - Webshop
---
classDiagram
    note "+ = public, - = private, # = protected"
    %% A <|-- B means that class B inherits from class A %%
    HtmlDoc <|-- BasicDoc

    BasicDoc <|-- HomeDoc
    BasicDoc <|-- AboutDoc
    BasicDoc <|-- FormDoc
    BasicDoc <|-- ProductDoc

    FormDoc <|-- ContactDoc
    FormDoc <|-- LoginDoc
    FormDoc <|-- RegisterDoc
    FormDoc <|-- PasswordDoc

    ProductDoc <|-- WebshopDoc
    ProductDoc <|-- DetailDoc
    ProductDoc <|-- Top5Doc
    ProductDoc <|-- CartDoc

    class HtmlDoc{
       +show()
       -showHtmlStart()
       -showHeaderStart()
       #showHeaderContent()
       -showHeaderEnd()
       -showBodyStart()
       #showBodyContent()
       -showBodyEnd()
       -showHtmlEnd()
    }
    class BasicDoc{
        #data 
        +__construct(mydata)
        #showHeaderContent()
        #showTitle()
        -showTitleStart()
        #showTitleContent()
        -showTitleEnd()
        -showCssLinks()
        #showBodyContent()
        #showHeader()
            -showHeaderStart()
            #showHeaderContent()
            -showHeaderEnd()
        -showMenu()
        #showContent()
        -showFooter()
    }
    class HomeDoc{
        #showTitleContent()
        #showHeadeContentr()
        #showContent()
    }
    class AboutDoc{
        #showTitleContent()
        #showHeaderContent()
        #showContent()
    }
    class FormDoc{
        <<abstract>>
        #showFormStart()
        #showFormContent()
        #showFormStart()
        #showFormField()
        $showFormEnd()
        -showInputSectionStart()
        -showInputSectionEnd()
        #showSubmitButton()
        #showFormEnd()
    }
    class ContactDoc{
        #showTitleContente()
        #showHeaderContent()
        #showContent()
        #showFormContent()
        
    }
    class LoginDoc{
        #showTitleContente()
        #showHeaderContent()
        #showContent()
        #showFormContent()
    }
    class RegisterDoc{
        #showTitleContente()
        #showHeaderContent()
        #showContent()
        #showFormContent()
    }
    class PasswordDoc{
        #showTitleContent()
        #showHeaderContent()
        #showContent()
        #showFormContent()
    }

    class ProductDoc{
        <<abstract>>
        #showProductContent()
        -showProductMenu()
        -showProductImage()
        -showProductLink()
        -showProductPrice()
        -showProductName()
        -showProductDescription()
        -showCartButton()
    }

    class WebshopDoc{
        #showTitleContent()
        #showHeaderContent()
        #showContent()
    }

    class Top5Doc{
        #showTitleContent()
        #showHeaderContent()
        #showContent()
    }

    class DetailDoc{
        #showTitleContent()
        #showHeaderContent()
        #showContent()
    }

    class CartDoc{
        #showTitleContent()
        #showHeaderContent()
        #showContent()
    }


```
