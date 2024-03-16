#include <iostream>
#include <cstring>

class MyString {
private:
    char* m_data;
    int m_length;

public:
    MyString(const char* data) {
        m_length = strlen(data);
        m_data = new char[m_length + 1];
        strcpy(m_data, data);
    }

    MyString(const MyString& other) {
        m_length = other.m_length;
        m_data = new char[m_length + 1];
        strcpy(m_data, other.m_data);
    }

    MyString& operator=(const MyString& other) {
        if (this != &other) {
            delete[] m_data;
            m_length = other.m_length;
            m_data = new char[m_length + 1];
            strcpy(m_data, other.m_data);
        }
        return *this;
    }

    ~MyString() {
        delete[] m_data;
    }

    void display() {
        std::cout << m_data << std::endl;
    }
};

int main() {
    MyString str1("Hello");
    MyString str2 = str1;
    MyString str3("World");
    str3 = str2;

    str1.display();
    str2.display();
    str3.display();

    return 0;
}