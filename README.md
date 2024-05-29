# ABC Web Site

This repository contains the source code for the ABC Children's Studio information system. The project aims to utilize PHP and SQL to create a practical application that automates the studio's operations. The application manages class registrations, tracks attendance, and calculates fees with discount applications.

## Project Overview

ABC Children's Studio operates daily from 9:00 AM to 5:00 PM, offering various classes. The studio includes the following five clubs:

| #  | Club Name                      | Number of Classes |
|----|--------------------------------|-------------------|
| 1  | Choreographic School           | 50                |
| 2  | Music School                   | 70                |
| 3  | Art School                     | 70                |
| 4  | Robotics School                | 70                |
| 5  | Drama School                   | 50                |

### Registration Information

When registering a new student, the following information is required:

- IIN
- Full Name
- Club Name
- Contact Phone Number
- Address (Street, House, Apartment)

### Fee Structure

The cost of one hour of training is 1000 KZT. Fees are only charged for attended classes. Discounts are provided under the following conditions:

- 15% discount for enrollment in two or more clubs.
- 5% discount for students younger than 10 years old.
- Discounts do not combine; the highest applicable discount is applied.

## Objectives

The information system aims to automate the operations of ABC Children's Studio, with features that include:

- Data entry with prompts and clear error messages.
- Well-named variables, constants, and identifiers for readability.
- Comprehensive and contextual responses for exam questions related to the project.

## Getting Started

### Prerequisites

- PHP
- MySQL or MariaDB
- A web server (e.g., XAMPP)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/EZDAMIR/ABC-Web-Site
