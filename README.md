# mapping

map JSON or XML file or API with YAML config file

# how to install 
composer require armd/mapping

# how to use

if you have a JSON like below, and you want to change your "products" key to "merchandise" and also you want to change the first product's "description" key to "details":
```
{
    "products": [
        {
            "id": 1,
            "title": "iPhone 9",
            "description": "An apple mobile which is nothing like apple",
            "price": 549,
            "discountPercentage": 12.96,
            "rating": 4.69,
            "stock": 94,
            "brand": "Apple",
            "category": "smartphones",
            "thumbnail": "https://dummyjson.com/image/i/products/1/thumbnail.jpg",
            "images": [
                "https://dummyjson.com/image/i/products/1/1.jpg",
                "https://dummyjson.com/image/i/products/1/2.jpg",
                "https://dummyjson.com/image/i/products/1/3.jpg",
                "https://dummyjson.com/image/i/products/1/4.jpg",
                "https://dummyjson.com/image/i/products/1/thumbnail.jpg"
            ]
        }
    ],
    "total": 100,
    "skip": 0,
    "limit": 30
}
```

You should write your YAML file like this:
```
products: 
  value: "merchendise"
  child: 
    0:
      child:
        description:
          value: "details"
```
 
