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

    FormDoc <|-- ContactDoc
    FormDoc <|-- LoginDoc
    FormDoc <|-- RegisterDoc
    FormDoc <|-- PasswordDoc

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
        -showTitle()
        -showCssLinks()
        #showBodyContent()
        #showHeader()
        -showMenu()
        #showContent()
        -showFooter()
    }
    class HomeDoc{
        #showHead()
        #showHeader()
        #showContent()
    }
    class AboutDoc{
        #showHead()
        #showHeader()
        #showContent()
    }
    class FormDoc{
        <<abstract>>
        +submitButton()
    }
    class ContactDoc{
        #showHead()
        #showHeader()
        #showContent()
    }
    class LoginDoc{
        #showHead()
        #showHeader()
        #showContent()
    }
    class RegisterDoc{
        #showHead()
        #showHeader()
        #showContent()
    }
    class PasswordDoc{
        #showHead()
        #showHeader()
        #showContent()
    }

    class ProductDoc{
        <<abstract>>
        +getProducts()
    }

    class WebshopDoc{
        #showHead()
        #showHeader()
        #showContent()
    }

    class Top5Doc{
        #showHead()
        #showHeader()
        #showContent()
    }

    class Detail{
        #showHead()
        #showHeader()
        #showContent()
    }

    class Cart{
        #showHead()
        #showHeader()
        #showContent()
    }


```
