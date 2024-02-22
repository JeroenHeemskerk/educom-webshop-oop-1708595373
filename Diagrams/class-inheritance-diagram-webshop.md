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
        #showSubmitButton()
        #showFormEnd()
    }
    class ContactDoc{
        #showTitleContente()
        #showHeaderContent()
        #showContent()
        #showFormStart()
        #showFormContent()
        
    }
    class LoginDoc{
        #showTitleContente()
        #showHeaderContent()
        #showContent()
        #showFormStart()
        #showFormContent()
    }
    class RegisterDoc{
        #showTitleContente()
        #showHeaderContent()
        #showContent()
        #showFormStart()
        #showFormContent()
    }
    class PasswordDoc{
        #showTitleContent()
        #showHeaderContent()
        #showContent()
        #showFormStart()
        #showFormContent()
    }

    class ProductDoc{
        <<abstract>>
        +getProducts()
    }

    class WebshopDoc{
        #showTitleContent()
        #showHeaderContent()
        #showContent()
    }

    class Top5Doc{
        -getTop5Productids()
        #showTitleContent()
        #showHeaderContent()
        #showContent()
    }

    class DetailDoc{
        -getDetailsProduct()
        #showTitleContent()
        #showHeaderContent()
        #showContent()
    }

    class CartDoc{
        -getCartContent()
        #showTitleContent()
        #showHeaderContent()
        #showContent()
    }


```
