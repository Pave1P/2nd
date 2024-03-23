#include <iostream>
#include <string>
#include <cstring>

using namespace std;

class MyString {
private:
    char* str;

public:
    // Конструктор
    MyString(const char* s = "") {
        str = new char[strlen(s) + 1];
        strcpy(str, s);
    }

    // Конструктор копирования
    MyString(const MyString& other) {
        str = new char[strlen(other.str) + 1];
        strcpy(str, other.str);
    }

    // Оператор присваивания копированием
    MyString& operator=(const MyString& other) {
        delete[] str;
        str = new char[strlen(other.str) + 1];
        strcpy(str, other.str);
        return *this;
    }

    // Деструктор
    ~MyString() {
        delete[] str;
    }

    const char* getString() {
        return str;
    }
};

int main() {
    MyString s1("Hello C++"); // Создание объекта s1 класса MyString

    MyString s2 = s1; // Использование конструктора копирования

    MyString s3(""); // Создание объекта s3 класса MyString

    s3 = s1; // Использование оператора присваивания копированием

    cout << s1.getString() << endl;
    cout << s2.getString() << endl;
    cout << s3.getString() << endl;

    return 0;
}
