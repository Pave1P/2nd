#include <iostream>
#include <cstring>
#include <string>

class MyString {
private:
    std::string str;

public:

    // конструктор
    MyString(std::string s) {  

        str = s;
    }
    // конструктор копирования
    MyString(const MyString& other) {

        str = other.str;
    }
    // оператор присваивания копированием
    MyString& operator=(const MyString& other) {

        if (this != &other) {

            str = other.str;
        }
        return *this;
    }

    // деструктор
    ~MyString() {}

    std::string getString() const {

        return str;
    }
};

int main() {
    MyString s1("Hi"); // создание объекта s1 класса MyString

    MyString s2 = s1; // использование конструктора копирования

    MyString s3(""); // создание объекта s3 класса MyString

    s3 = s1; // использование оператора присваивания копированием

    std::cout << s1.getString() << std::endl;
    std::cout << s2.getString() << std::endl;
    std::cout << s3.getString() << std::endl;

    return 0;
}