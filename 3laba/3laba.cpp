#include <iostream>
#include <string>
using namespace std;
class MyString {
private:
    string str;
public:
    // конструктор
    MyString(string s) {
        str = s;
    }
    // конструктор копирования
    MyString(const MyString& other) {
        str = other.str;
    }
    // оператор присваивания копированием
    MyString& operator=(const MyString& other) {
        str = other.str;
        return *this;
    }
    // деструктор
    ~MyString() {}
    string getString() {
        return str;
    }
};
int main() {
    MyString s1("Hello world"); // создание объекта s1 класса MyString

    MyString s2 = s1; // использование конструктора копирования

    MyString s3(""); // создание объекта s3 класса MyString

    s3 = s1; // использование оператора присваивания копированием
    cout << s1.getString() << endl;
    cout << s2.getString() << endl;
    cout << s3.getString() << endl;

    return 0;
}
