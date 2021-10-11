# Weather App DDD CQRS

First, thank you very much for taking time to review this!
I spent way more time than you recommended for the task, but I saw this
as a good chance to practice some knowledge that I never had the chance to apply in any of
the companies I worked for and please consider this as my first attempt at "proper" ddd and cqrs :)

I have included one bounded context diagram and the diagram for the class relationship.

The code inside sec\Weather\Partners\Shared is mostly copy and paste code to lay the foundation for using 
commands and queries. The rest is code written the past few days for this task.
I have aimed for clean readable code, well enforced and encapsulated invariants and less for designing and Api.

#The extra mile
- No test, sorry I have spent a lot of time with the project
- Yes there is one extra diagram
- Sorry, I have spent a lot of time with this already

#ToDo or improve if I had more time
- Add Docker
- Add psalm
- Add CS
- Add test
- OpenApi docs  
- ErrorHandler (Currently there is no way to return a json response in case of an exception)
- Custom Exceptions (I have done only one or two due to time but definitely needed more)
- Move parts of config at aggregates BC level
- Proxy Cache Repository for each partner. Currently, the cache is being handled by the same repository that fetches the data
this breaks the single responsibility principle, so a proxy would be perfect in such case
- Proper Criteria object and everything that comes with it to be able to search

These are some things that come to my mind atm.

#Testing
- I am a unit test person and less an e2e person.
e2e test can be covered with a variety of tools and not necessarily done by a dev.
I would cover first all parts were logic seem more complicated, parts were code looks less robust and prone to break.
This would help prevent bugs in future and also improve the code exposed by the tests.

- (Code lines executed by tests / total code lines) * 100 = code coverage in percent 
  If you expected me to know this answer I am sorry to tell you that I just copied it from google :P
  I am not much of a QA guy, usually these are things you figure out with a QA engineer. 
  Come up with a plan and how to achieve it.

#Specification
- PHP 8
- Symfony 5.3

# How to run
from root: php -S localhost:8080 -t public ;) (wink wink)

#Api
/api/predictions?city=Amsterdam&date=12-10-2021&scale=celsius

#Notes
- Date is in the past in all data sources provided so plz inside Domain/Data/ValueObject/Date plz comment out the exception
- The diagrams have been created before code was finished, so they are slightly different. U can find them in root forlder inside docs
- I have implemented only 2 out of 3 partners cuz again I have spent a lot of time on this.
