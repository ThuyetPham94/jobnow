<?php

use Illuminate\Database\Seeder;

class JobTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        for ($i = 0; $i < 10; $i++) {
            DB::table('Job')->insert([
                'CompanyID' => 1,
                'Title' => 'HCM - Business Development Executive (Japanese Clients) - Vietnamworks',
                'Position' => 'staff',
                'Level' => 1,
                'YearOfExperience' => 'No need Experience',
                'LocationID' => 1,
                'FromSalary' => 10000000,
                'ToSalary' => 20000000,
                'CurrencyID' => 1,
                'IndustryID' => 1,
                'IsDisplaySalary' => 1,
                'Description' => 'What You Will Do
Japanese Business Unit at VietnamWorks is looking for a sales-passionate member, who would like to work with Japanese clients to help them recruit effectively via vietnamworks.com websites. 

As a Business Development Executive for Japanese team, you will spend your ideal day to: 

* Taking care of an assigned Japanese client portfolio to generate the maximum revenue on client satisfaction basis.
* Developing an extensive Japanese customer database
* Reaching out to dedicated clients via phone, emails and sometimes face to face meetings
* Building TRUST and maintain good rapport with customers.
* Giving advice to customers to help them attract candidates using Vietnamworks.com jobsite.
* Retain, up-sell/gross-sell existing customers and create new customers
* Being responsible for individual sales target.
* Carry out other tasks assigned by team leader and Manager

Successful candidates will have chances to:
* Earn unlimited remuneration based on performance.
* Get the oversea travel prizes.
* Get the Monthly, Quarterly Best Sales prizes.
* Be trained and improve selling skills via many soft skills courses at international standards.
* Work in a dynamic, international and friendly environment with fun events and socializing activities.',
                'Requirement' => 'To take this challenging role, we expect our candidates: 

- Passionate for Sales/ Business Development
- Having at least 2 years experience in sales with proven records.
- Experience in Telesales or B2B is a plus.
- Good communication skill in both Vietnamese and English.
- Fun & Hard working, Can-do attitude.',
                'IsActive' => 1,
                'Latitude' => '20.993462',
                'Longitude' => '105.846858',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('Job')->insert([
                'CompanyID' => 1,
                'Title' => 'Vietnamworks Tuyển Chuyên Viên Telesales',
                'Position' => 'staff',
                'Level' => 1,
                'YearOfExperience' => 'No need Experience',
                'LocationID' => 1,
                'FromSalary' => 10000000,
                'ToSalary' => 20000000,
                'CurrencyID' => 1,
                'IndustryID' => 1,
                'IsDisplaySalary' => 1,
                'Description' => 'BẠN ĐANG TÌM KIẾM MỘT CÔNG VIỆC:

• Có môi trường năng động, thân thiện, chuyên nghiệp, đầy thách thức cùng với đội ngũ tư vấn chuyên nghiệp, kinh nghiệm và máu lửa;
• Được làm việc tại trang web tuyển dụng trực tuyến số 1 Việt Nam;
• Được phát triển bản thân và tham gia các khóa đào tạo theo chuẩn quốc tế;
• Thu nhập hấp dẫn, xứng đáng với khả năng và thành tích cá nhân;
• Chiến thắng giải thưởng Best Sales cùng chuyến du lịch nước ngoài 2 lần/năm và những giải thưởng hấp dẫn khác.


VIETNAMWORKS KỲ VỌNG GÌ Ở CÁC BẠN?

• Thực hiện các cuộc gọi tìm hiểu nhu cầu và tư vấn, thương thảo về dịch vụ với khách hàng.
• Quản lý và khai thác tốt danh mục khách hàng được phân công phụ trách.
• Lập kế hoạch kinh doanh cho cá nhân theo tuần, tháng, quý đáp ứng được các yêu cầu của Công ty.
• Hoàn thành các chỉ tiêu được đặt ra về số lượng cuộc gọi, chất lượng, số lượng đơn hàng hàng ngày.
• Là người đại diện chuyên nghiệp của VietnamWorks.',
                'Requirement' => 'What You Are Good At
HÃY NẮM LẤY CƠ HỘI NÀY NGAY, NẾU BẠN:

• Có ít nhất 1 năm kinh nghiệm trong lĩnh vực kinh doanh và đam mê với công việc kinh doanh;
• Là người Việt Nam, giọng nói chuẩn, không ngọng, không giọng địa phương;
• Sắn sàng đối diện khó khăn để vượt qua chỉ tiêu doanh số;
• Có khả năng thích nghi và làm việc nhóm tốt;
• Vui vẻ, thân thiện, trung thực, kiên trì;
• Ham học hỏi, có thái độ cầu tiến, cầu thị;
• Ưu tiên ứng viên nộp hồ sơ sớm.',
                'IsActive' => 1,
                'Latitude' => '20.994814',
                'Longitude' => '105.860323',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('Job')->insert([
                'CompanyID' => 1,
                'Title' => 'Urgent! 10 Senior Java Developer - Up To 1500usd',
                'Position' => 'staff',
                'Level' => 1,
                'YearOfExperience' => 'No need Experience',
                'LocationID' => 1,
                'FromSalary' => 10000000,
                'ToSalary' => 20000000,
                'CurrencyID' => 1,
                'IndustryID' => 3,
                'IsDisplaySalary' => 1,
                'Description' => 'Develop web Applications we are looking for developers who are passionate about developing great software, have a love for solving hard problems, and enjoy learning about new technology.
+Benefits:
- Salary package: Competitive and negotiable 
- Salary review: 2 times/ year
- Lunch & parking allowance .
- Premium Health Insurance.
- Language training: Japanese/ English (Company sponsor)
- Applicable for all normal benefits: insurance, 13th month salary, incentive bonus, annual outing trip, team building activities
- Sport activities: Football, swimming, badminton etc. (Company sponsor)
- Working environment: dynamic, innovative and friendly.',
                'Requirement' => '•Excellent understanding and commercial experience in Java
•Deep architectural understanding of web applications 
•Experience in any of the following is also an advantage: RESTful Web Service, API Gateway, Drive, Maven, XML/XSD/XSLT, Agile/Scrum, Jira Agile, Confluence, Git/Bitbucket, Eclipse.
•Good knowledge in some back end technologies like Spring, Hibernate, or others
•Knowledge in some of the standard front end technologies like CSS, JavaScript (JQuery, ember.js or Angular.js), node.js, REST, JSON
•Broad knowledge and understanding of the software industry',
                'IsActive' => 1,
                'Latitude' => '21.002635',
                'Longitude' => '105.871034',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }

}
