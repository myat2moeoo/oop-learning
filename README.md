Class and Object

A class is like a blueprint. It describes what something should be like, but it is not the real thing.
An object is the actual item created from that blueprint. ** Class = idea/plan ** Object = real thing created from that idea.
Constructors

A constructor is special setup method inside a class. It runs automatically when we create an object.
The purpose is to initialize value for the object.
Access Modifiers

Access Modifiers decide who can use or see the data inside a class.
Public: Anyone can use it
Protected: Only the class itself and its child can use it. = Private: Only the class itself can use it.
Encapsulation

Encapsulation is keeping data safe by hiding the details inside a class and only allow controlled acces through methods. => Encapsulation = Hide data + Provide controlled access
Inheritance

Inheritance mean a child class can reuse the properites and method of a parent class.
It prevents writing the same code again and again.
Polymorphism

Polymorphism = One name, Many forms ** the same method can different behavior depending on the object that uses it. => Work with inheritance and abstract class / can also work with interfaces.
Interface Interface = rules that classes must follow, only declare method name without code. Why it's important?

Ensure all classes follow the same rules.
Makes code consistent and organized
Abstract Class

An abstract class is like a rulebook with incomplete instructions. We can't use it directly.
But any child class must complete the missing parts before it can be used. ** Normal calss is complete. So, we can use it directly to make object. ** Abstract class is incomplete. So, We cannot make object from it. It's only starting point for other classes. => Why use abstract??? Sometime we know the common things all child(class) should have, but we don't know exactly the details. So, we create abstract class to set the rules. Example: Every Animal must have: - a way to eat - a way to make sound. But we don't know the exact sound and food for each animal. So, we make abstract class Animal with "abstract methods" - sound() - eat() Then every child(like dog, cat) must fill in the details. - Dog: sound = bark, eat = bone - Cat: sound = meow, eat = fish
Static Method

Static method can be called directly on the class without needing to create an object first. **To access static method use the class name, double colon (::) and the method name. e.g., ClassName::StaticMethod();