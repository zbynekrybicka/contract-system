describe('Contacts', () => {
  beforeEach(() => {
    cy.visit('http://localhost:5173')
    cy.get("input[name=email]").type("test@demo.cz")
    cy.get("input[name=password]").type("password123")
    cy.get("button").click()
    cy.intercept('POST', '/login').as('login');
    cy.wait('@login')
  })

  it('New contact', () => {
    cy.get("nav [href='/contacts']").click()

    cy.get(".button-new-contact").click()

    cy.get(".new-contact input[name=firstname]").type("Radek")
    cy.get(".new-contact input[name=middlename]").type("ethanol")
    cy.get(".new-contact input[name=lastname").type("Brezina")

    cy.get(".new-contact select[name=dialnumber]").select("420")
    cy.get(".new-contact input[name=phonenumber]").type("542123059")
    cy.get(".new-contact input[name=email]").type("radek.brezina@gmail.com")

    cy.get(".new-contact button").click()
    cy.intercept('POST', '/contact').as('postContact');
    cy.wait('@postContact')
  })

  it('Edit contact', () => {
    cy.get("nav [href='/contacts']").click()
    cy.get(".contact-list .contact-list.item").click()

    cy.get(".edit-contact input").focus()
    cy.get(".edit-contact input").focus()
    cy.get(".edit-contact input").focus()

    cy.get(".edit-contact select").focus()
    cy.get(".edit-contact input").focus()
    cy.get(".edit-contact input").focus()

    cy.get(".edit-contact button").click()
  })
})